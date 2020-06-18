<tr id="row_{{$row}}">
	<td>
		<input type="text" class="form-control" name="product_name[]" value="{{$res->name}}" readonly >
		<input type="hidden" name="pid[]" class="pid" value="{{$res->id}}" readonly/>
		<input type="hidden" id="code_{{$row}}" data-id="{{$row}}" name="code[]" class="code" value="{{$res->code}}" readonly/>		
	</td>

	<td>
	<input type="text" name="price[]" class="price form-control" id="price" value="{{$res->price}}"readonly/>
	</td>

	<td>
		<input type="text" id="qty_{{$row}}" name="qty[]" class="qty form-control" id="qty" value="1"/>
		<input type="hidden" name="tqty[]" class="tqty" id="tqty" value="{{$res->stock}}"/>
	</td>

	<td>
	<span class="amt" id="amt_{{$row}}">{{$res->price}}</span>
	</td>

	<td><button type="button" name="remove" class="btn btn-danger btn-sm remmove"><span class="glyphicon glyphicon-minus"></span></button></td>
</tr>