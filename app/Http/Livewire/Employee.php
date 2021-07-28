<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Employee as EmployeeModel;

class Employee extends Component
{   
    public $name, $salary, $id_employee, $date;
    public $employeeName, $employeeSalary, $employeeAttendance;
    public $attendance = 0;
    public $detailEmployee = 0;

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
    }

    public function edit($id)
    {
        $employee = EmployeeModel::find($id);
        $today = Carbon::today();
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

        if ($employee->date != $today) {
            EmployeeModel::where('id',$employee->id)->update([
                'attendance' => $employee->attendance+1,
                'date'       => $today,
            ]);
        }
    }

    public function resetAbsen($id)
    {
        $employee = EmployeeModel::find($id);
        EmployeeModel::where('id',$employee->id)->update([
            'attendance' => 0,
            'date'       => '',
        ]);
    }
}
