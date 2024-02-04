<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">New Sales</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>       
                @endif    
                <form id="submitform"   method="post" > 
                @csrf
                Product:
                <select id="product">
                    <option>Select</option>
                    <option value="1">Arabic Coffe</option>
                    <option value="2">Gold Coffe</option>
                </select>
                <br>
            <br> 
            Quantity:
            <input type="text" id="qty" name="name">
            <br>
            <br> 
            Unit Cost :
            <input type="text" id="cost" name="email">
            <br>
            <br>
            Selling Price :
            <input type="text" name="sellingPrice" id="sellingPrice" value="0">
            <br>
            <br>
            <input type="submit" id="record_sale" name="submit"
                   value="Record Sale">
        </form>  
        Previous Sales
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th> 
     <th scope="col">Product</th>
      <th scope="col">Quantity</th>
      <th scope="col">Unit Cost</th>
      <th scope="col">Selling Price</th>
      <th scope="col">Sold at</th>
    </tr>
  </thead>
  <tbody>
  @foreach($previous_sales as $user)
   <tr>
       <th scope="row">{{ $user->id }}</th> 
       <td>{{ $user->product }}</td>
      <td>{{ $user->qty }}</td>
      <td>{{ $user->price }}</td>
      <td>{{ $user->selling_price }}</td>
      <td>{{ $user->created_at }}</td>
    </tr>
@endforeach     
  </tbody>        
            </div>
        </div>
    </div>    
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() { // alert("AAAAA");
    $('#submitform').submit(function (event) {  //alert("AAAAA"); 
   event.preventDefault();
   productval = $("#product option:selected").val();  
   productname = $("#product option:selected").text(); 
    
    qty = $("#qty").val();
    cost = $("#cost").val();
   $.ajaxSetup({

headers: { 
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
} 
});  
   $.ajax({
      type: "POST",
      url: "{{ route('newsale1') }}",
      dataType: 'JSON',
      cache: false,
      data: {productname:productname, productval:productval,qty:qty, cost:cost},
      //data: $(this).serialize(),
       success: function (data) {  
        console.log(data.success); 
       $('#sellingPrice').val(data.sp); 
      },
      error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText + textStatus + " - " + errorThrown);
        }
    });
}); 
  });
</script>