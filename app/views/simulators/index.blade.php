 @extends('layout')
 @section('content')
<style type="text/css">
	th,td {
		padding: 10px;
	}
	.filter_dropdown {
		float: left;
	}
</style>
<script type="text/javascript">
    $(document).ready(function(){
       $(".filter_btn").on('click',function(){
        
        var $this = $(this);
        var filters = [];
        var i = 0;
		
		$(".filters").each(function(){
			filters[i] = $(this).val();
			i++;
		});

        $.ajax({
            type: $this.data('method'),
            url: $this.data('href'),
            data: {category_names: filters},
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
             	//alert($(".TV")[0].selectedIndex);
             	var type_media = ['#reach','#frequency','#grp','#media','#contribution'];
             	var i = 0;
             	$.each(response,function(key,value) {
             		j = 0;
             		$.each(value,function(key1,data) {
             			$(type_media[j]+i).html(data['column_1']);
             			j = j+1;
             		});
             		i = i+1;
             	});
            },
            error: function(response) {
                alert("Invalid data");
            }
        });
      });
    });
</script>
<div class="row clearfix">
<div class="col-md-12 column">
<div class="panel panel-default">
<div class="panel-heading">
<div class="row">
<div class="col-md-10"><h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Simulator</h2></div>
</div>
<div class="row">   
   <div class="col-lg-4" style="margin-bottom:15px;">
	<div class="form-group">
 
        <?php $count = 0; ?>
        @foreach($data_columns as $key => $value)
        <p class="filter_dropdown">{{$category_names[$count]}}
        <select class="form-control filters">
	            <option value="{{$value}}" class="form-control">{{$value}}</option>
        </select>
        </p>
            <?php $count++; ?>
        @endforeach
    </div>
	</div>

</div>
<div class="row">   
   <div class="col-lg-4" style="margin-bottom:15px;">
	<div class="form-group">
		<table border="1">
			<tr>
				<th>Base</th>
				<th>Non-Media Uplift</th>
				<th>Media Uplift</th>
				<th>Total</th>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</div>
	</div>
</div>	
<button class="btn btn-info filter_btn" style="float:right;" data-method="post" data-href="{{Request::root()}}/simulator/filters">Filter</button><br/>
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
				            	<th colspan="2">{{$value}}</th>
				            	<?php $pos = strpos($value,'&'); ?>
				            	@if($pos)
				            	   <?php $count++;?>
				            	@endif
				            	<?php $counter++; ?>
			        @endforeach
			        <?php $count = $counter - $count; ?>        
		    	</tr>
		    	
		    	<tr>
			    	@for ($i = 0; $i < $count; $i++)
	    				<td colspan="2">
	    					<select class="{{$data_columns_fix[$i]}}">
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
		    		@for ($i = 0; $i < $counter; $i=$i+1)
	    				<td class="{{$data_columns_fix[$i]}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="reach{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="frequency{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="grp{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="media{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="contribution{{$i}}">&nbsp;</td>
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