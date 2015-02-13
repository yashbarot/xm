 @extends('layout')
 @section('content')
<style type="text/css">
	th,td {
		padding: 10px;
	}
</style>
<div class="row clearfix">
<div class="col-md-12 column">
<div class="panel panel-default">
<div class="panel-heading">
<div class="row">
<div class="col-md-10"><h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Simulator</h2></div>
   
   <div class="col-lg-12" style="margin-bottom:15px;">
	<div class="form-group">
 
        <?php $count = 0; ?>
        @foreach($data_columns as $key => $value)
        {{$category_names[$count]}}<select class="form-control">
        	@foreach($value as $filter)
	        	@if($filter != NULL)
	            <option value="{{$filter}}" class="form-control">{{$filter}}</option>
	            @endif
            @endforeach
            </select>
            <?php $count++; ?>
        @endforeach         
    
    </div>
	</div>

	<div class="row">
		<div class="col-md-2">
			
			<table border="1">
				<tr>
					<th>Constant Values</th>
				</tr>
				<tr>
					<td>Increase/Decrease Budget</td>
				</tr>
				<tr>
					<td>Reach</td>
				</tr>
				<tr>
					<td>Frequency</td>
				</tr>
				<tr>
					<td>GRPs</td>
				</tr>
				<tr>
					<td>Uplift</td>
				</tr>
				<tr>
					<td>Share of Contribution</td>
				</tr>
			</table>
				
		</div>
		<div class="col-md-8">
			<table border="1">
				<tr>
					<?php $counter = 0;$count = 0; ?>
			        @foreach($data_columns_fix as $key => $value)
			        	@foreach($value as $filter)
				        	@if($filter != NULL)
				            	<th colspan="2">{{$filter}}</th>
				            	<?php $pos = strpos($filter,'&'); ?>
				            	@if($pos)
				            	   <?php $count++;?>
				            	@endif
				            	<?php $counter++; ?>
				            @endif
			            @endforeach
			        @endforeach
			        <?php $count = $counter - $count; ?>         
		    	</tr>
		    	
		    	<tr>
			    	@for ($i = 0; $i < $count; $i++)
	    				<td colspan="2">
	    					<select>
	    						@foreach($scenarios as $scenario)
	    						@if($scenario->value == '100')
	    							<option value="{{$scenario->id}}" selected="selected" >{{$scenario->value}}</option>
	    						@else
	    							<option value="{{$scenario->id}}">{{$scenario->value}}</option>
	    						@endif	
	    						@endforeach
	    					</select>
	    				</td>
					@endfor
					@for ($j = 0; $j < $counter - $count; $j++)
	    				<td colspan="2">
	    				</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td >&nbsp;</td>
					@endfor
					@for ($i = 0; $i < $counter; $i++)
	    				<td >&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td>&nbsp;</td>
					@endfor
					@for ($i = 0; $i < $counter; $i++)
	    				<td >&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td>&nbsp;</td>
					@endfor
					@for ($i = 0; $i < $counter; $i++)
	    				<td >&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td>&nbsp;</td>
					@endfor
					@for ($i = 0; $i < $counter; $i++)
	    				<td >&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td>&nbsp;</td>
					@endfor
					@for ($i = 0; $i < $counter; $i++)
	    				<td >&nbsp;</td>
					@endfor
		    	</tr>

			</table>
		</div>	
	</div>

	

</div>
</div>
</div>
</div>
</div>
 @stop