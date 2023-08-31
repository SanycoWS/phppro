## Instruction

```bash
cp docker-compose.override.yml.dist docker-compose.override.yml
cp storage/supervisor.conf/programs.conf.cp storage/supervisor.conf/programs.conf
cp .env.example .env
make build
make up
make sh
composer install
```
