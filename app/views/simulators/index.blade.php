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

        var request = $.ajax({
					            type: $this.data('method'),
					            url: $this.data('href'),
					            data: {category_names: filters,id:$this.data('id')},
					            dataType: 'json'
					        });
        
        request.done(function(response){
        	data_array = response;
             	var type_media = ['#reach_100','#frequency_100','#grp_100','#media_100','#contribution_100'];
             	var i = 0;
             	$.each(response,function(key,value) {
             		j = 0;
             		$.each(value,function(key1,data) {
             			$(type_media[j]+i).html(data['column_1']);
             			j = j+1;
             		});
             		i = i+1;
             	});
	        });

        var request1 = $.ajax({
					            type: $this.data('method'),
					            url: $this.data('projects'),
					            data: {category_names: filters,id:$this.data('id')},
					            dataType: 'json'
					        });

        request1.done(function(response1){
        		$("#base").html(response1.column_15);
        		$("#non_uplift").html(response1.column_16);
	        });

        var request2 = $.ajax({
					            type: $this.data('method'),
					            url: $this.data('scenarios'),
					            data: {id:$this.data('id')},
					            dataType: 'json'
					        });
        request2.done(function(response2){
        		scenario_data = response2;
	        });

      });

		function nearest(n, v, e) {
			n = n / e;
		    n = n / v;
		    n = Math.round(n) * v;
		    return n;
		}

		$("select").on('change',function(){
			$("#total").html(((parseInt($("#media_uplift").html())) || 0 )+parseInt($("#base").html())+parseInt($("#non_uplift").html()));
		});
  		
  		$('select').on('change',function(){
  			var type_media1 = ['#reach','#frequency','#grp','#media','#contribution'];
  			var k = 0;
  			var z = 0;
  			var ab = $(this);
  			var index = $(this)[0].selectedIndex;
             	$.each(data_array,function(key,value) {
             		l = 0;
             		if(key == ab.attr('class')) {
	             		$.each(value,function(key1,data) {
	             			a = index+1;
	             			if(ab.val() != "100") {
	             				$(type_media1[l]+k).html(data['column_'+a]);
	             			} else {
	             				$(type_media1[l]+k).html("");
	             			}
	             			l = l+1;
	             		});
	             	}
             		k = k+1;
             	});
            $.each(data_array,function(key,value) {
             		if(key.indexOf('&') > -1) {
             			
             			var split = key.split('&');
             			
             			if(split.length == 2) {
             				var add_value = parseInt($("#"+split[0]).val())+parseInt($("#"+split[1]).val());
             				var temp_value = nearest(add_value,5,2);
             			} if(split.length == 3) {
             				var add_value = parseInt($("#"+split[0]).val())+parseInt($("#"+split[1]).val())+parseInt($("#"+split[2]).val());
             				var temp_value = nearest(add_value,5,3);
             			} if(split.length == 4) {
             				var add_value = parseInt($("#"+split[0]).val())+parseInt($("#"+split[1]).val())+parseInt($("#"+split[2]).val())+parseInt($("#"+split[3]).val());;
             				var temp_value = nearest(add_value,5,4);
             			}
             			var data_key;
             				for (data in scenario_data) {
             					if(scenario_data[data] == temp_value) {
             						data_key = data;
  								}
             				}
             				l = 0;
             				$.each(value,function(key1,data) {
             					b = parseInt(data_key)+1;
	             				$(type_media1[l]+z).html(data['column_'+b]);
	             				l = l+1;
	             			});
             		}
             		z = z+1;
             	});
  		});
    });
</script>
<div class="col-md-12 column">
<div class="panel panel-default">
<div class="panel-heading">
<div class="row">
<div class="col-md-10"><h2>Simulator</h2></div>
</div>
<hr style="margin-top: 0px;margin-bottom: 25px;"/>
<div class="row" style="margin-left: 1px;">   
   <div class="col-lg-5" style="margin-bottom:15px;border:1px solid #999;">
	<div class="form-group">
 	
        <?php $count = 0; ?>
        @foreach($data_columns as $filters)
		        <p class="filter_dropdown" style="margin: 5px;text-transform: capitalize;font-weight:600;">{{$category_names[$count]}}
		        <select class="form-control filters">
		        <?php echo '<pre>'; var_dump($filters); ?>
		        @foreach($filters as $filter)
			            <option value="{{$filter}}" class="form-control">{{$filter}}</option>
			    @endforeach
		        </select>
		        </p>
		        <?php $count++; ?>
        @endforeach
        <button class="btn btn-info filter_btn" style="float:right;margin: 20px;" data-id="{{$id}}" data-method="post" data-href="{{Request::root()}}/simulator/filters" data-projects="{{Request::root()}}/simulator/projects" data-scenarios="{{Request::root()}}/simulator/scenarios">Filter</button><br/>
    </div>
	</div>
</div>
<div class="row" style="margin-left: 1px;">   
  
	<div class="form-group">
		<table border="1" style="border: 1px solid #999;margin-bottom:15px;"  class="col-lg-5" id="first_table">
			<tr>
				<th>Base</th>
				<th>Non-Media Uplift</th>
				<th>Media Uplift</th>
				<th>Total</th>
			</tr>
			<tr>
				<td id = "base">&nbsp;</td>
				<td id = "non_uplift">&nbsp;</td>
				<td id = "media_uplift">&nbsp;</td>
				<td id = "total">&nbsp;</td>
			</tr>
		</table>
	</div>
	
</div>	

	<div class="row">
		<div class="col-md-2">
			
			<table border="1" style="border: 1px solid #999;">
				<tr>
					<th>Constant Values</th>
				</tr>
				<tr>
					<td style="height: 39px;">Increase/Decrease Budget</td>
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

		<div class="col-md-3" style="margin-left: -22px;overflow-x: scroll;max-width: 350px;width: 350px;">
			<table border="1" style="border: 1px solid #999;width: 335px;">
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
	    					<select class="{{$data_columns_fix[$i]}}" id="{{$data_columns_fix[$i]}}">
	    						@foreach($scenarios as $scenario)
	    						@if($scenario->value == '100')
	    							<option value="{{$scenario->value}}" selected="selected" >{{$scenario->value}}</option>
	    						@else
	    							<option value="{{$scenario->value}}">{{$scenario->value}}</option>
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
	    				<td class="{{$data_columns_fix[$i]}}" id="reach{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="reach_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}" id="frequency{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="frequency_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}" id="grp{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="grp_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}" id="media{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="media_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}" id="contribution{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="contribution_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>

			</table>
		</div>	
	</div>

<div class="row" style="margin-top:15px;">
		<div class="col-md-2">
			
			<table border="1" style="border: 1px solid #999;">
				<tr>
					<th style="height: 39px;">&nbsp;</th>
				</tr>
				<tr>
					<td>Media Spend(Million RMB)</td>
				</tr>
				<tr>
					<td>Media Uplift<label style="color:red;">*</label></td>
				</tr>
				<tr>
					<td>Cost efficiency<label style="color:red;">**</label></td>
				</tr>
			</table>
				
		</div>

		<div class="col-md-3" style="margin-left: -22px;overflow-x: scroll;max-width: 350px;width: 350px;">
			<table border="1" style="border: 1px solid #999;width: 335px;">
				<tr>
					<?php $counter = 0;$count = 0; ?>
			        @foreach($data_columns_fix as $key => $value)
				            	
				            	<?php $pos = strpos($value,'&'); ?>
				            	@if($pos)
				            	   <?php $count++;?>
				            	@else
				            	<th colspan="2">{{$value}}</th>   
				            	@endif
				            	<?php $counter++; ?>
			        @endforeach
			        <?php $count = $counter - $count; ?>
			        <th colspan="2">Total</th>
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i=$i+1)
	    				<td class="{{$data_columns_fix[$i]}}" id="reach{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="reach_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}" id="frequency{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="frequency_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>
		    	<tr>
		    		@for ($i = 0; $i < $counter; $i++)
	    				<td class="{{$data_columns_fix[$i]}}" id="grp{{$i}}">&nbsp;</td>
	    				<td class="{{$data_columns_fix[$i]}}" id="grp_100{{$i}}">&nbsp;</td>
					@endfor
		    	</tr>

			</table>
		</div>	
	</div>
	<div class="row">
		<div class="col-md-5">
			<table border="1" style="border:1px solid #999;">
				<tr>
					<th>Planned Impacts</th>
				</tr>
				<tr>
					<th>Simulated Impacts</th>
				</tr>
			</table>
		</div>
		
	</div>
<ul style="list-style:none;padding-left: 0px;padding-top: 10px;color:red;">
			<li>*Total media uplift includes synergies</li>
			<li>**Cost efficiency = Uplift/Spend</li>
		</ul>
</div>
</div>
</div>
</div>
</div>
 @stop