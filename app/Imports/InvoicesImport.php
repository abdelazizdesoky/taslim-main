<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoicesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new Invoice([
            'code' => $row['code'],
            'invoice_type' => $row['invoice_type'],
            'invoice_date' => date('Y-m-d'),
            'location_id'=> $row['location_id'],
            'employee_id'=> $row['employee_id'],
            'customer_id' => $row['customer_id'],
            'supplier_id' => $row['supplier_id'],
            'invoice_status' => $row['invoice_status'],
        ]);
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255',
            'invoice_type' => 'required|string',
            'invoice_date' => 'required|date',
            'location_id' => 'required|integer|exists:location,id',
            'employee_id' => 'required|integer|exists:admins,id',
            'supplier_id' => 'nullable|integer|exists:location,id',
            'customer_id' => 'nullable|integer|exists:location,id',
            'invoice_status' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a string.',
            'code.max' => 'The code may not be greater than 255 characters.',
            
            'invoice_type.required' => 'The invoice type field is required.',
            'invoice_type.string' => 'The invoice type must be a string.',
    
            'invoice_date.required' => 'The invoice date field is required.',
            'invoice_date.date' => 'The invoice date must be a valid date.',
    
            'location_id.required' => 'The location ID field is required.',
            'location_id.integer' => 'The location ID must be an integer.',
            'location_id.exists' => 'The selected location ID does not exist.',
    
            'employee_id.required' => 'The employee ID field is required.',
            'employee_id.integer' => 'The employee ID must be an integer.',
            'employee_id.exists' => 'The selected employee ID does not exist in admins table.',
    
            'supplier_id.integer' => 'The supplier ID must be an integer.',
            'supplier_id.exists' => 'The selected supplier ID does not exist in location table.',
    
            'customer_id.integer' => 'The customer ID must be an integer.',
            'customer_id.exists' => 'The selected customer ID does not exist in location table.',
    
            'invoice_status.required' => 'The invoice status field is required.',
            'invoice_status.string' => 'The invoice status must be a string.',
        ];
    }


}

