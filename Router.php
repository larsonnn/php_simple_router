<?php

class Router {
	private array $routes;
	private array $paths;
    private string $controllerPath;

    private string $controllerKey = ":controller";

	public function __construct(string $routesFilePath, string $controllerPath) {
		$raw_path = $_SERVER["REQUEST_URI"];

		$this->routes = json_decode(
			file_get_contents($routesFilePath), true
		);

        $this->controllerPath = $controllerPath;

		$this->paths =  array_values(
			array_filter(
				explode("/", $raw_path),
				fn($value) => !is_null($value) && $value !== ''
			)
		);
	}

	public function run(): void
    {
		$pathsCount = count($this->paths) -1;

		$path = $this->routes;
		$found = false;
		for($i = 0; $i <= $pathsCount; $i++) {
			$path = $path[$this->paths[$i]];

            if(!isset($path)){
                break;
            }

			if($i == $pathsCount) {
				if(isset($path[$this->controllerKey])) {
					$found = true;
					require $this->controllerPath . "/" . $path[$this->controllerKey];
				}
				break;
			}
		}
		
		if(!$found) {
            http_response_code(404);
            die();
		}
	}
	
}
