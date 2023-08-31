<?php

declare(strict_types=1);

namespace App\Services\SuperVisor;

use Exception;
use fXmlRpc\Transport\HttpAdapterTransport;
use GuzzleHttp\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Supervisor\Configuration\Loader\IniFileLoader;
use Supervisor\Configuration\Section\Program;
use Supervisor\Configuration\Writer\IniFileWriter;
use Supervisor\Supervisor;

class SuperVisorService
{
    private const SECTION_PREFIX = 'program:';
    private const PROCESS_NAME_FORMULA = '%(program_name)s_%(process_num)02d';
    private const AUTO_START = true;
    private const AUTO_RESTART = true;
    private const USER = 'www-data';
    private const START_RETRIES = 7125;
    private Supervisor $supervisor;

    public function __construct()
    {
        $guzzleClient = new Client(
            [
                'auth' => [
                    config('supervisor.user'),
                    config('supervisor.password'),
                ],
            ]
        );
        $client = new \fXmlRpc\Client(
            config('supervisor.clientUrl'),
            new HttpAdapterTransport(
                new GuzzleMessageFactory(),
                $guzzleClient
            )
        );
        $this->supervisor = new Supervisor($client);
    }

    public function stopProcesses(string $processName): bool
    {
        try {
            $this->supervisor->stopProcessGroup($processName);

            return true;
        } catch (Exception $exception) {
            var_dump($exception->getMessage());

            return false;
        }
    }

    public function startProcesses(string $processName): bool
    {
        try {
            $this->supervisor->startProcessGroup($processName);

            return true;
        } catch (Exception $exception) {
            var_dump($exception->getMessage());

            return false;
        }
    }

    /**
     * @param ProcessDTO $dto
     * @return void
     */
    public function addProcessesConfig(ProcessDTO $dto): void
    {
        try {
            $filePath = config('supervisor.configPath');
            $config = (new IniFileLoader($filePath))->load();
            if ($config->hasSection(self::SECTION_PREFIX . $dto->getName()) === true) {
                return;
            }
            $section = new Program(
                $dto->getName(), [
                    'command' => $dto->getCommand(),
                    'process_name' => self::PROCESS_NAME_FORMULA,
                    'autostart' => self::AUTO_START,
                    'autorestart' => self::AUTO_RESTART,
                    'user' => self::USER,
                    'numprocs' => $dto->getNumber(),
                    'startretries' => self::START_RETRIES,
                ]
            );
            $config->addSection($section);
            (new IniFileWriter($filePath))->write($config);
            $this->supervisor->reloadConfig();
        } catch (Exception $exception) {
        }
    }

    public function hasSection(string $name): bool
    {
        $filePath = config('supervisor.configPath');
        $config = (new IniFileLoader($filePath))->load();

        return $config->hasSection(self::SECTION_PREFIX . $name);
    }

    public function updateProcesses(ProcessDTO $dto): void
    {
        try {
            $filePath = config('supervisor.configPath');
            $config = (new IniFileLoader($filePath))->load();
            if ($config->hasSection(self::SECTION_PREFIX . $dto->getName()) === false) {
                return;
            }
            $config->removeSection(self::SECTION_PREFIX . $dto->getName());
            $section = new Program(
                $dto->getName(), [
                    'command' => $dto->getCommand(),
                    'process_name' => self::PROCESS_NAME_FORMULA,
                    'autostart' => self::AUTO_START,
                    'autorestart' => self::AUTO_RESTART,
                    'user' => self::USER,
                    'numprocs' => $dto->getNumber(),
                    'startretries' => self::START_RETRIES,
                ]
            );
            $config->addSection($section);
            (new IniFileWriter($filePath))->write($config);
            $this->supervisor->reloadConfig();
        } catch (Exception $exception) {
        }
    }

    public function deleteProcess(string $processName): void
    {
        try {
            $filePath = config('supervisor.configPath');
            $config = (new IniFileLoader($filePath))->load();
            if ($config->hasSection(self::SECTION_PREFIX . $processName) === false) {
                return;
            }
            $config->removeSection(self::SECTION_PREFIX . $processName);
            (new IniFileWriter($filePath))->write($config);
            $this->supervisor->reloadConfig();
        } catch (Exception $exception) {
        }
    }
}
