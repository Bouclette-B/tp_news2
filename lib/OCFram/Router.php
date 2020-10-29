<?php

namespace OCFram;
class Router
{
    protected $routes = [];
    const NO_ROUTE = 1;

    public function addRoutes(Route $route)
    {
        if(!in_array($route, $this->routes))
        {
            array_push($this->routes, $route);
        }
    }

    public function getRoute($url)
    {
        foreach ($this->routes as $route)
        {
            //Si la route correspond à l'URL
            if(($varsValues = $route->match($url)) !== false)
            {
                //Si la route a des variables
                if($route->hasVars())
                {
                    $varsNames = $route->getVarsNames();
                    $listVars  = [];

                    //création d'un tableau clé/valeur (clé = nom de la variable)
                    foreach($varsValues as $key => $match)
                    {
                        if($key !== 0)
                        {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    $route->setVars($listVars);
                }
                return $route;
            }
        }
        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}