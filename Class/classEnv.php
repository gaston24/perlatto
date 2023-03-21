<?php


class DotEnv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;


    public function __construct(string $path)
    {
        if(!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;
    }

    private function load() :void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }

    public function listVars(){
        (new DotEnv(__DIR__ . '/../.env'))->load();

        $vars = array(

            'HOST_PROD' => getenv('HOST_PROD'),
            'HOST_DEV' => getenv('HOST_DEV'),
            'DATABASE' => getenv('DATABASE'),
            'USER' => getenv('USER'),
            'PASS' => getenv('PASS'),
            'USER_DEV' => getenv('USER_DEV'),
            'PASS_DEV' => getenv('PASS_DEV'),
            'PASS_LOCALES' => getenv('PASS_LOCALES'),
            'CHARACTER' => getenv('CHARACTER'),
            'ENV' => getenv('ENV'),

        );

        return $vars;


    }

}