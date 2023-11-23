<?php


namespace Ebog;


class OpisFrontendController
{
    private $opismodel;
    public function __construct($opisModel)
    {
        $this->opismodel = $opisModel;
    }
    public function iopis()
    {
       echo $this->opismodel->getAll();
       echo '<br/>';  echo '<br/>';

        $this->opismodel->addJohnDoe();

        echo '<br/>';  echo '<br/>';
        echo $this->opismodel->getAll();

        $this->opismodel->deleteJohnDoe(8);

        echo '<br/>';  echo '<br/>';
        echo $this->opismodel->getAll();

        $arr = array(
            'title' => 'New',
            'image'=>'',
            'content' => 'Туц Соте');

        $this->opismodel->updateJohnDoe(12, $arr);

        echo '<br/>';  echo '<br/>';
        echo $this->opismodel->getAll();

    }
    public function oneopis($id)
    {
        echo $this->opismodel->getByID($id);
    }
}