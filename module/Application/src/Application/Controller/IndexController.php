<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use PDO;
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $con = new PDO("firebird:dbname=localhost/3050:C:/Flavio/Projetos/php/firebird/data/BASEFB.FDB","SYSDBA","masterkey");$stmt = $con->query("select * from teste");
        if($_POST)
        {
            $valor = $_POST['texto'];
            //$con = ibase_connect("localhost/3050:C:/Flavio/Projetos/php/firebird/data/BASEFB.FDB","SYSDBA","masterkey");
            for( $i=0; $i<=1; $i++)
            {
                $ins = $con->prepare("INSERT INTO TESTE( CAMPO ) VALUES (:CAMPO)");
                $ins->bindParam(":CAMPO", $valor );
                $ins->execute();
            }
            
            
            /*$stmt = $con->query("select * from teste");
            foreach ( $stmt as $row ){
                print_r( $row );
            }*/
        }
        /*foreach ( $stmt as $row ){
            echo sprintf("<p> %s </p>", $row['CAMPO'] );
        }*/
        return new ViewModel(array(
            'dados' => $con->query("select * from teste")
        ));
    }
}
