@extends('layouts.app')

@section('content')
    <div class="container">
        <h2> Invoice List </h2>
        <p>
            <a href="{{ route('invoicecreate')}}" class="btn btn-primary">
                Create Invoice 
            </a>
        </p>
        <form class="form-inline" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label for="filter" class="form-label">Name</label>
                        <input type="text" class="form-control col-md-12"  name="name" placeholder="Name..." value="<?php echo isset($_GET['name'])?$_GET['name']:''; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label for="filter" class="form-label">Rating</label>
                        <input type="text" class="form-control col-md-12"  name="rating" placeholder="Rating..." value="<?php echo isset($_GET['rating'])?$_GET['rating']:''; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label for="filter" class="form-label">Invoice No</label>
                        <input type="text" class="form-control col-md-12"  name="invoice_no" placeholder="Invoice No..." value="<?php echo isset($_GET['invoice_no'])?$_GET['invoice_no']:''; ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info mb-2 ">Search</button>
        </form>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>S No</th>
                    <th>Name</th>
                    <th>Invoice Id</th>
                    <th>Rating</th>
                    <th> File</th>
                </tr>
            </thead>
            <tbody>
            @if ($invoice->count() == 0)
            <tr>
                <td colspan="5">No invoice to display.</td>
            </tr>
            @endif
                <?php $i = 1; ?>
                @foreach($invoice as $key=>$value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->invoice_id }}</td>
                        <td>{{ $value->rating }}</td>
                        <td><a href="{{ $value->file_path }}" target="_blank"> View </a></td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection