class CategoryCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CategoryCreated $event): void
    {
        $keys = [
            $event->getUserId() . "_" . "user" => Redis::get($event->getUserId() . "_" . "user"),
            $event->getUserId() . "_" . $event->getRoute() => Redis::get(
                $event->getUserId() . "_" . $event->getRoute()
            ),
        ];

        foreach ($keys as $key => $value) {
            if ($value === null) {
                Redis::set($key, 1, 'EX', 600);
            }
            if ($value > 0) {
                Redis::incr($key);
            }
            if ($key === $event->getUserId() . "_" . "user" && $value > 30) {
                Log::info('multiple route');
            }
            if ($key === $event->getUserId() . "_" . $event->getRoute() && $value > 10) {
                Log::info('single route');
            }
        }
    }


}
