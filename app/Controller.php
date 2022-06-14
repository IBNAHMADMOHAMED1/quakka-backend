<?php
abstract class Controller
{
    /**
     * Afficher une vue
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    public function render(string $fichier, array $data = [])
    {
        extract($data);
        ob_start();
        require_once(ROOT . 'views/' . strtolower(get_class($this)) . '/' . $fichier . '.php');
        $content = ob_get_clean();
        require_once(ROOT . 'views/layout/default.php');
    }

    /**
     * Permet de charger un modèle
     *
     * @param string $model
     * @return void
     */
    public function loadModel(string $model)
    {
        require_once(ROOT . 'models/' . $model . '.php');
        $this->$model = new $model();
       
    }
}
