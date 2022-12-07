<?php
defined('BASEPATH') or exit('No direct script access allowed');

require FCPATH.'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        is_login();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Employee_Model', 'employee'); 
        $this->load->model('Division_Model', 'division');
        $this->load->model('Hour_Model', 'hour');
        $this->load->model('Presence_Model', 'presence'); 

    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $data['present'] = $this->presence->getCountPresent(); 
        $data['not_present'] = $this->presence->getCountNotPresent();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/index', $data);
        $this->load->view('templates/footer');
    }

    public function employee_data()
    {
        $data['title'] = 'Employee Data';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['employee'] = $this->employee->getAll(); 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/employee_data', $data);
        $this->load->view('templates/footer');
    } 

    public function update_employee_data($username) 
    { 
        $data['title'] = 'Edit Employee Data';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['employee'] = $this->employee->getEmployeebyUname($username); 
        $data['division'] = $this->division->getAll();

        $this->form_validation->set_rules('firstName', 'first name', 'required|trim');
        $this->form_validation->set_rules('lastName', 'last name', 'required|trim'); 
        $this->form_validation->set_rules('div_id', 'div_id', 'required|trim');

        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/edit_employee_data', $data);
        $this->load->view('templates/footer'); 
        } else { 
            $this->employee->update_data($data); 
            $this->session->set_flashdata('flash', 'updated'); 

            redirect('administrator/employee_data');
        }
    } 

    public function delete_employee_data($username) 
    { 
        $data['title'] = 'Delete Employee Data';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['employee'] = $this->employee->getEmployeebyuname($username); 

        $this->employee->delete_data($username); 
        $this->session->set_flashdata('flash', 'deleted'); 

        redirect('administrator/employee_data');
        
    }

    public function division_data()
    {
        $data['title'] = 'Division Data';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $data['division'] = $this->division->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/division_data', $data);
        $this->load->view('templates/footer');
    } 

    public function create_division_data()
    {
        $data['title'] = 'Division Data';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $this->form_validation->set_rules('div_id', 'division id', 'required|trim');
        $this->form_validation->set_rules('div_name', 'division name', 'required|trim'); 

        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/add_division_data', $data);
        $this->load->view('templates/footer'); 
        } else { 
            $this->division->insert_data($data); 
            $this->session->set_flashdata('flash', 'updated'); 

            redirect('administrator/division_data');
        }
    } 

    public function update_division_data($div_id) 
    { 
        $data['title'] = 'Edit Division Data';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['division'] = $this->division->getDivisionbydivid($div_id);

        $this->form_validation->set_rules('div_id', 'division id', 'required|trim');
        $this->form_validation->set_rules('div_name', 'division name', 'required|trim'); 

        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/edit_division_data', $data);
        $this->load->view('templates/footer'); 
        } else { 
            $this->division->update_data($data); 
            $this->session->set_flashdata('flash', 'updated'); 

            redirect('administrator/division_data');
        }
    } 

    public function delete_division_data($div_id) 
    { 
        $data['title'] = 'Delete Division Data';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['division'] = $this->division->getDivisionbydivid($div_id); 

        $this->division->delete_data($div_id); 
        $this->session->set_flashdata('flash', 'deleted'); 

        redirect('administrator/division_data');
    }

    public function presence_history() { 
        $data['title'] = 'Presence History';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $data['presence'] = $this->presence->getPresenceperDay();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/presence_history', $data);
        $this->load->view('templates/footer');
    } 

    public function presence_settings() { 
        $data['title'] = 'Presence Settings';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $data['hour'] = $this->hour->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/presence_settings', $data);
        $this->load->view('templates/footer');
    }  

    public function update_presence_hour() { 
        $data['title'] = 'Edit Presence Hour';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $data['hour'] = $this->hour->getHourbyhourid($hour_id); 

        $this->form_validation->set_rules('start', 'start time', 'required|trim');
        $this->form_validation->set_rules('finished', 'finished time', 'required|trim'); 

        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/presence_settings', $data);
        $this->load->view('templates/footer'); 
        } else { 
            $this->hour->update_data($data); 
            $this->session->set_flashdata('flash', 'updated'); 

            redirect('administrator/presence_settings');
        }
    } 

    public function presence_report() { 
        $data['title'] = 'Presence Report';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $username = $this->input->get('username');
        $month = @$this->input->get('month') ? $this->input->get('month') : date('m');
        $year = @$this->input->get('year') ? $this->input->get('year') : date('Y'); 

        $data['employee'] = $this->employee->getEmployeebyroleid();
        $data['hour'] = (array) $this->hour->getAll();
        $data['all_months'] = month();
        $data['month'] = $month;
        $data['year'] = $year;
        $data['day'] = day_month($month, $year); 

        $data['presentrep'] = $this->presence->getPresenceReport($username, $month, $year);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/presence_report', $data);
        $this->load->view('templates/footer');
    }

    public function export_excel_presentrep() { 
        $username = @$this->uri->segment(3) ? $this->uri->segment(3) : $this->session->userdata('username');
        $month = @$this->input->get('month') ? $this->input->get('month') : date('m');
        $year = @$this->input->get('year') ? $this->input->get('year') : date('Y'); 

        $data['employee'] = $this->employee->getEmployeebyuname($username); 
        $data['hour'] = (array) $this->hour->getAll();
        $data['all_months'] = month();
        $data['month'] = $month;
        $data['year'] = $year;
        $data['day'] = day_month($month, $year); 

        $data['presentrep'] = $this->presence->getPresenceReport($username, $month, $year);

        $day = $data['day'];

        $presentrep = $data['presentrep'];

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
                    ->setCreator('Symphony Technical Support Centre PT Boon Software')
                    ->setLastModifiedBy('Symphony Technical Support Centre PT Boon Software')
                    ->setTitle('Presence Data')
                    ->setSubject('Presence')
                    ->setDescription('Presence Data ' . $data['employee']->firstName . ' ' .$data['employee']->lastName . ' in ' . month($data['month']) . ', ' . $data['year'])
                    ->setKeyWords('presence data');

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ]
        ];

        $style_row_weekend = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => '343A40']
            ],
            'font' => [
                'color' => ['argb' => 'FFFFFF']
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ]
        ];

        $style_row_not_present = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'D9E2EF']
            ],
            'font' => [
                'color' => ['argb' => '000000']
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ]
        ]; 

        $style_on_time = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => '0275D8']
            ],
            'font' => [
                'color' => ['argb' => '000000']
            ]
        ];

        $style_out_of_time = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'D9534F']
            ],
            'font' => [
                'color' => ['argb' => '000000']
            ]
        ]; 

        $style_permission = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'F0AD4E']
            ],
            'font' => [
                'color' => ['argb' => '000000']
            ]
        ]; 

        $style_over_time = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => '5CB85C']
            ],
            'font' => [
                'color' => ['argb' => '000000']
            ]
        ]; 

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Symphony Technical Support Centre PT Boon Software');
        $spreadsheet->getActiveSheet()->mergeCells('A1:F1');
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'Name : ' . $data['employee']->firstName . ' ' . $data['employee']->lastName);
        $spreadsheet->getActiveSheet()->mergeCells('A2:F2');
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', 'Division : ' . $data['employee']->div_name);
        $spreadsheet->getActiveSheet()->mergeCells('A3:F3');
        $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', '');
        $spreadsheet->getActiveSheet()->mergeCells('A4:F4');

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A5', 'Presence Data in ' . month($data['month']) . ', ' . $data['year']);
        $spreadsheet->getActiveSheet()->mergeCells('A5:F5');
        $spreadsheet->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A5')->getFont()->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A6', 'No');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B6', 'Day, Date');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C6', 'Get In Hour');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D6', 'Status Get In'); 
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E6', 'Get In Hour');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F6', 'Status Get Out');

        $spreadsheet->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('D6')->applyFromArray($style_col); 
        $spreadsheet->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);

        $numrow = 7;
        foreach ($day as $i => $d) {
            $presenceperday = array_search($d['date'], array_column($presentrep, 'date')) !== false ? $presentrep[array_search($d['date'], array_column($presentrep, 'date'))] : '';

            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$numrow, ($i+1));
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $d['day'] . ', ' . $d['date']);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$numrow, is_weekend($d['date']) ? '-' : check_hour(@$presenceperday['get_in_h'], 1, true)['text']); 
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$numrow, is_weekend($d['date']) ? 'weekend' : check_hour(@$presenceperday['get_in_h'], 1, true)['status']);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$numrow, is_weekend($d['date']) ? '-' : check_hour(@$presenceperday['get_out_h'], 2, true)['text']); 
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$numrow, is_weekend($d['date']) ? 'weekend' : check_hour(@$presenceperday['get_out_h'], 2, true)['status']);


            if ((check_hour(@$presenceperday['get_in_h'], 1, true)['status'] == 'on time')) {
                $spreadsheet->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_on_time);
            }

            if (check_hour(@$presenceperday['get_in_h'], 1, true)['status'] == 'out of time') {
                $spreadsheet->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_out_of_time);
            } 

            if (check_hour(@$presenceperday['get_out_h'], 2, true)['status'] == 'on time') {
                $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_on_time);
            } 

            if (check_hour(@$presenceperday['get_out_h'], 2, true)['status'] == 'permission') {
                $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_permission);
            }

            if (check_hour(@$presenceperday['get_out_h'], 2, true)['status'] == 'over time') {
                $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_over_time);
            }

            if (is_weekend($d['date'])) {
                $spreadsheet->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row_weekend);
                $spreadsheet->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row_weekend);
                $spreadsheet->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row_weekend);
                $spreadsheet->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row_weekend); 
                $spreadsheet->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row_weekend);
                $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row_weekend);
            } elseif ($presenceperday == '') {
                $spreadsheet->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row_not_present);
                $spreadsheet->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row_not_present);
                $spreadsheet->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row_not_present);
                $spreadsheet->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row_not_present); 
                $spreadsheet->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row_not_present);
                $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row_not_present);
            } else {
                $spreadsheet->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
                $spreadsheet->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
                $spreadsheet->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
                $spreadsheet->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row); 
                $spreadsheet->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
                $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            }
            $numrow++;
        }

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25); 
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Presence' . '_' . $data['employee']->firstName . '-' . $data['employee']->lastName . '_' . month($data['month']) . ' ' . $data['year'] . '.xlsx"'); // Set the excel file name
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

}