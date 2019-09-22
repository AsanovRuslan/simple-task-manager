<?php


namespace BeeJee\App;


use Zend\Diactoros\Response;

class TemplateResponse extends Response\HtmlResponse
{
    /** @var string */
    private $template_name;
    /**
     * @var array
     */
    private $params;

    public function __construct(string $template_name, array $params = [], int $status = 200, array $headers = [])
    {
        $this->template_name = $template_name;
        $this->params        = $params;

        parent::__construct($this->getTemplateAsString(), $status, $headers);
    }

    private function getTemplateAsString()
    {
        extract($this->params);
        ob_start();
        include(APP_PATH . '/src/Views/' . $this->template_name . '.php');

        return ob_get_clean();
    }
}