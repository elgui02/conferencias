<?php
namespace Umg\ConferenciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Ddeboer\DataImport\Reader\ExcelReader;
use Symfony\Component\HttpFoundation\Response;
use PHPExcel;
use PHPExcel_IOFactory;
use Umg\ConferenciaBundle\Entity\Evento;
use Umg\ConferenciaBundle\Entity\Alumno;
use Umg\ConferenciaBundle\Form\EventoType;

class CargarArchivoController extends Controller
{
    public function indexAction($id)
    {
      return $this->render('UmgConferenciaBundle:CargarArchivo:index.html.twig',array(
          'ev'=>$id,
      ));
    }
    
    public function showAction(Request $request)
    {
      if($request->getMethod() == 'POST')
      {
          $archivo =$request->files->get('archivo');
          #$this->showAction($archivo);
      }

      $em = $this->getDoctrine()->getManager();
      $evento = $em->getRepository('UmgConferenciaBundle:Evento')->findOneById($request->get('evento'));  
      
      $inputFileName=$archivo;
      //lectura del archivo
      try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);

          } 
      catch (Exception $e) 
          {
            die('Error al Cargar el Archivo "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
          }

        //obtencion del tamaño del columnas, filas
        $sheet =$objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  blucle atraves de cada fila
        $file= array();
      for ($row = 1; $row <= $highestRow; $row++)
      {
      //lee una fila de datos de la matriz
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL, TRUE, FALSE);
        foreach($rowData[0] as $k=>$v)
        $data =$rowData[0];
      //Obtencion del Codigo de Alumnos
          if($row > 5)
          {
            $file[]= $data;
          }
      }
      
      $lista= $highestRow - 6;
      /*
      Obtencion de los numeros de carnet segun cvs
      */
      for ($contalum = 0; $contalum <= $lista; $contalum++)
      {
        foreach($file[$contalum] as $m=>$v)
        if($m == 1)
          {
            $codeStudents[]=$v;
          }
       }
      /*
      Obtencion del los nombres de los alumnos segun cvs
      */ 
      for ($contalum = 0; $contalum <= $lista; $contalum++)
      {
        foreach($file[$contalum] as $m=>$v)
        if($m == 2)
          {
            $nameStudents[]=$v;
          }
      }
      var_dump($codeStudents);
      var_dump($nameStudents);
    }
}
