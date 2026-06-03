<?php

namespace App\Controller;

use App\Entity\Contacto;
use App\Repository\ContactoRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactoController extends AbstractController
{
    public function __construct(private readonly ContactoRepository $contactoRepository)
    {
    }
    #[Route('/contacto/', name: 'contacto_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('contacto/index.html.twig', [
            'contactos' => $this->contactoRepository->findAll(),
        ]);
    }
    #[Route('/contacto/', name: 'contacto_export', methods: ['POST'])]
    public function contactosExport(Request $request): Response
    {
        $fechaInicial = $request->request->get('fecha_inicial');
        $fechaFinal = $request->request->get('fecha_final');
// Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $contactos = $this->contactoRepository->findByDates($fechaInicial, $fechaFinal);

// Set document properties
        $spreadsheet->getProperties()->setCreator('Industrias Novaquim SAS')
            ->setLastModifiedBy('Industrias Novaquim SAS')
            ->setTitle('Contactos Web')
            ->setSubject('Contactos Web')
            ->setDescription('Contactos Web')
            ->setKeywords('Contactos Web')
            ->setCategory('Contacto');
// Add some data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id')
            ->setCellValue('B1', 'Nombre de contacto')
            ->setCellValue('C1', 'Organización')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Teléfono')
            ->setCellValue('F1', 'Celular')
            ->setCellValue('G1', 'Tipo de consulta')
            ->setCellValue('H1', 'Mensaje')
            ->setCellValue('I1', 'Fecha contacto');


// Rename sheet
        $spreadsheet->getActiveSheet()->setTitle('Contactos Web');

        $j = 2;
        foreach ($contactos as $contacto) {
            $spreadsheet->getActiveSheet()->setCellValue([1, $j], $contacto->getId());
            $spreadsheet->getActiveSheet()->setCellValue([2, $j], $contacto->getNombreContacto());
            $spreadsheet->getActiveSheet()->setCellValue([3, $j], $contacto->getOrganizacion());
            $spreadsheet->getActiveSheet()->setCellValue([4, $j], $contacto->getEmailContacto());
            $spreadsheet->getActiveSheet()->setCellValue([5, $j], $contacto->getTelefono());
            $spreadsheet->getActiveSheet()->setCellValue([6, $j], $contacto->getCelular());
            $spreadsheet->getActiveSheet()->setCellValue([7, $j], $contacto->getTipoConsulta());
            $spreadsheet->getActiveSheet()->setCellValue([8, $j], $contacto->getMensaje());
            $spreadsheet->getActiveSheet()->setCellValue([9, $j++], $contacto->getFechaContacto());
        }

        for ($i = 'A'; $i <= $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
        }
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ContactosWeb.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

    }
}
