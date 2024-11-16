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
            'invoice_date.required' => 'The invoice date field is required.',
            'invoice_date.date' => 'The invoice date must be a valid date.',
            'location_id.required' => 'The location ID field is required.',
            'location_id.integer' => 'The location ID must be an integer.',
            'supplier_id.required' => 'The supplier ID field is required.',
            'supplier_id.integer' => 'The supplier ID must be an integer.',
            'invoice_status.required' => 'The invoice status field is required.',
        ];
    }


}

