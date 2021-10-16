<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Employee as EmployeeModel;

class Employee extends Component
{   
    public $name, $salary, $id_employee, $date;
    public $employeeName, $employeeSalary, $employeeAttendance;
    public $attendance = 0;
    public $detailEmployee = 0;
    public $titleForm = 'Add Employee';
    public $dates;
    public $emit;

    public function render()
    {
        $employee = EmployeeModel::orderBy('name')->get();
        return view('livewire.employee', [
            'employee' => $employee,
        ]);
    }

    public function show($id)
    {
        $employee = EmployeeModel::find($id);
        $this->employeeName = $employee->name;
        $this->employeeAttendance = $employee->attendance;
        $this->employeeSalary = $employee->salary;
        $this->showDetail();
    }

    public function showDetail()
    {
        $this->detailEmployee = true;
    }

    public function closeDetail()
    {
        $this->detailEmployee = false;
    }

    public function store()
    {
        $today = Carbon::today();
        $this->validate([
            'name'      => 'required',
            'salary'    => 'required|numeric',
        ]);

        EmployeeModel::updateOrCreate(['id' => $this->id_employee],[
            'name'          => $this->name,
            'attendance'    => $this->attendance,
            'salary'        => $this->salary,
            'date'          => $this->date,
        ]);

        $this->name = '';
        $this->salary = '';
        $this->attendance = '0';
        $this->date = '2021-06-21 00:00:00';
        $this->titleForm = 'Add Employee';
    }

    public function edit($id)
    {
        $employee = EmployeeModel::find($id);
        $this->titleForm    = 'Edit Employee';
        $this->id_employee  = $employee->id;
        $this->name         = $employee->name;
        $this->salary       = $employee->salary;
        $this->attendance   = $employee->attendance;
        $this->date         = $employee->date;
    }

    public function destroy($id)
    {
        $employee = EmployeeModel::find($id);
        $employee->delete();
    }

    public function absen($id)
    {
        $employee = EmployeeModel::find($id);
        $today = Carbon::today();
        $this->dates = $today->format('Y-m-d');
        if ($employee->date != $this->dates) {
            EmployeeModel::where('id',$employee->id)->update([
                'attendance' => $employee->attendance+1,
                'date'       => $this->dates,
            ]);
        }
        $this->emit('alert',['type' => 'success', 'message' => 'Comment added successfully']);
    }

    public function resetAbsen()
    {
        $employees = EmployeeModel::all();
        
        $employee = $employees->map(function ($item){
            return [
                'id' => $item->id,
                'attendance' => $item->attendance,
                'date'  => $item->date,
            ];
        });

        foreach ($employee as $row) {
            $karyawan = EmployeeModel::find($row['id']);

            if($karyawan->attendance === 0){
                return session()->flash('error','Karyawan belum pernah melakukan absensi');
            }
            
            $karyawan->update([
                'attendance' => 0,
                'date'  => '',
            ]);
            
        }
    }
}
