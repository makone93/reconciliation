<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReconcileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function reconcileDocuments(Request $request)
    {
        $csvLedger = null;
        $csvStatement = null;
        $ledgerRows = [];
        $statementRows = [];
        $mergedRowsByInvoice = [];
        // Initialize the array to store unmatched statement rows
        $unmatchedStatementRows = [];

        if ($request->hasFile('csvLedger') && $request->hasFile('csvStatement')) {
            $csvLedger = $request->file('csvLedger');
            $csvStatement = $request->file('csvStatement');


            // ledger rows
            if (($handle = fopen($csvLedger, 'r')) !== false) {
                $firstRow = true;
                $columnNames = []; // Array to store column names

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                    // Skip the first row
                    if ($firstRow) {
                        $columnNames = $data; // Assign column names
                        $firstRow = false;
                        continue;
                    }

                    // Combine column names with values to create associative array
                    $rowData = array_combine($columnNames, $data);
                    $ledgerRows[] = $rowData;
                    // $ledgerRows[] = $data;
                }
                fclose($handle);
            }

            // statement rows
            if (($handle = fopen($csvStatement, 'r')) !== false) {
                $firstRow = true;
                $columnNames = []; // Array to store column names

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                    // Skip the first row``
                    if ($firstRow) {
                        $columnNames = $data; // Assign column names
                        $firstRow = false;
                        continue;
                    }
                    // Combine column names with values to create associative array
                    $rowData = array_combine($columnNames, $data);
                    $statementRows[] = $rowData;
                    // $statementRows[] = $data;
                }
                fclose($handle);
            }


            foreach ($statementRows as $statementRow) {
                $statementValue = $statementRow["DocNumber"]; // Value at index 2 in statementRow

                // Initialize flag to track if a match is found
                $matchFound = false;

                foreach ($ledgerRows as $ledgerRow) {
                    $ledgerValue = $ledgerRow["DocumentType"]; // Value at index 0 in ledgerRow

                    // Define the length of the sequences
                    $sequenceLength = 10;

                    // Iterate over each position in $ledgerValue
                    for ($i = 0; $i <= strlen($ledgerValue) - $sequenceLength; $i++) {
                        // Extract a sequence of 10 characters from $ledgerValue starting at position $i
                        $ledgerSubsequence = substr($ledgerValue, $i, $sequenceLength);

                        // Compare the sequences
                        if ($ledgerSubsequence == $statementValue) {
                            // Merge the matching rows
                            $mergedRowsByInvoice[] = array_merge($ledgerRow, $statementRow);
                            // You might want to break here if you only want to merge once for each match
                            // Set flag to true since match is found
                            $matchFound = true;
                            break;
                        }
                    }
                    // If no match is found for the statement row, add it to the unmatched array
                    if (!$matchFound) {
                        $unmatchedStatementRows[] = $statementRow;
                    }
                    // // If no match is found for the statement row, add it to the unmatched array
                    // if (!$matchFound) {
                    //     array_push($unmatchedStatementRows, $statementRow);
                    // }
                }
            }

            $massArray = ["matchedInvoices" => $mergedRowsByInvoice, "unmatchedInvoices" => $unmatchedStatementRows];

            // return response()->json($statementRows, 200);
            return response()->json($massArray, 200);
        } else {
            return response()->json("No attached files found", 200);
        }
    }

    public function unmatchedEntries(Request $request)
    {
        $csvLedger = null;
        $csvStatement = null;
        $ledgerRows = [];
        $statementRows = [];
        $ledgerRowsUnmatched = [];
        $statementRowsUnmatched = [];

        if ($request->hasFile('csvLedger') && $request->hasFile('csvStatement')) {
            $csvLedger = $request->file('csvLedger');
            $csvStatement = $request->file('csvStatement');

            // ledger rows
            if (($handle = fopen($csvLedger, 'r')) !== false) {
                $firstRow = true;
                $columnNames = []; // Array to store column names

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                    // Skip the first row
                    if ($firstRow) {
                        $columnNames = $data; // Assign column names
                        $firstRow = false;
                        continue;
                    }

                    // Combine column names with values to create associative array
                    $rowData = array_combine($columnNames, $data);
                    $ledgerRows[] = $rowData;;
                }
                fclose($handle);
            }

            // statement rows
            if (($handle = fopen($csvStatement, 'r')) !== false) {
                $firstRow = true;
                $columnNames = []; // Array to store column names

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                    // Skip the first row``
                    if ($firstRow) {
                        $columnNames = $data; // Assign column names
                        $firstRow = false;
                        continue;
                    }
                    // Combine column names with values to create associative array
                    $rowData = array_combine($columnNames, $data);
                    $statementRows[] = $rowData;
                    // $statementRows[] = $data;
                }
                fclose($handle);
            }

            //search legder rows in statement
            foreach ($ledgerRows as $ledgerRow) {
                $found = false;

                //loop each row comparing it with the rest of statement rows
                foreach ($statementRows as $statementRow) {
                    $ledgerValue = $ledgerRow["DocumentType"]; // Value at index 0 in ledgerRow
                    $statementValue = $statementRow["DocNumber"];
                    // Define the length of the sequences
                    $sequenceLength = 10;

                    // Iterate over each position in $ledgerValue
                    for ($i = 0; $i <= strlen($ledgerValue) - $sequenceLength; $i++) {
                        $ledgerSubsequence = substr($ledgerValue, $i, $sequenceLength);
                        if ($ledgerSubsequence == $statementValue) {
                            $found = true;
                        }
                    }
                }
                if (!$found)
                    array_push($ledgerRowsUnmatched, $ledgerRow);
            }


            //search statement roes in ledger
            foreach ($statementRows as $statementRow) {
                $found = false;

                //loop each row comparing it with the rest of statement rows
                foreach ($ledgerRows as $ledgerRow) {
                    $ledgerValue = $ledgerRow["DocumentType"]; // Value at index 0 in ledgerRow
                    $statementValue = $statementRow["DocNumber"];
                    // Define the length of the sequences
                    $sequenceLength = 10;

                    // Iterate over each position in $ledgerValue
                    for ($i = 0; $i <= strlen($ledgerValue) - $sequenceLength; $i++) {
                        $ledgerSubsequence = substr($ledgerValue, $i, $sequenceLength);
                        if ($ledgerSubsequence == $statementValue) {
                            $found = true;
                        }
                    }
                }
                if (!$found)
                    array_push($statementRowsUnmatched, $statementRow);
            }







            return response()->json(['ledgerRows'=>$ledgerRowsUnmatched,'statementRows'=> $statementRowsUnmatched], 200);
        } else {
            return response()->json("No attached files found", 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
