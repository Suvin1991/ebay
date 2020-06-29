<?php  
	
	error_reporting(E_ERROR | E_PARSE);

	$data = [];
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	    if(isset($_POST['product_number']) && !empty($_POST['product_number'])){

	    	require_once 'dom-scrapper.php';
	    	$scrapper = new DomScrapper();

	    	$scrapper->process($_POST['product_number']);
	    	$data = $scrapper->result;
	    	
	    }
	}

?>

<!DOCTYPE doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
                <!-- Bootstrap CSS -->
                <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
                    <title>
                        Ebay Product Detais
                    </title>
                </link>
            </meta>
        </meta>
        <style>
            fieldset.scheduler-border {
			    border: 1px groove #ddd !important;
			    padding: 0 1.4em 1.4em 1.4em !important;
			    margin: 0 0 1.5em 0 !important;
			    -webkit-box-shadow:  0px 0px 0px 0px #000;
			            box-shadow:  0px 0px 0px 0px #000;
			}

		    legend.scheduler-border {
		        font-size: 1.2em !important;
		        font-weight: bold !important;
		        text-align: left !important;
		        width:auto;
		        padding:0 10px;
		        border-bottom:none;
		    }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <h4>
                        Submit product numbers!
                    </h4>
                    <form action="" id="submit-form" method="POST">
                        <div class="form-group" id="form-elements">
                            <label>
                                Product Number
                            </label>
                            <input class="form-control product-number" name="product_number[]" placeholder="Enter product number" type="number">
                            </input>
                        	</br>
                        </div>
                    </form>
                    <button class="btn btn-info" id="add-btn" title="Click to add another product number" type="button">
					    Add
					</button>
					<button class="btn btn-success" id="submit-btn" type="button">
					    Submit
					</button>
                </div>
            
	            <?php
	            	if(isset($data) && !empty($data)){
	            ?>
	            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	                <h4>
	                    Product details!
	                </h4>
	                <ul>
	            	<?php  
	            		foreach ($data as $key => $val) {
	            			echo '<li>';
	            			echo "<strong>Product Number: $key</strong>";
	            			echo '<ul>';
	            			echo '<li>';
	            			echo '<strong>Product Title: </strong>'.$val['title'];
	            			echo '</li>';
	            			echo '<li>';
	            			echo '<strong>Product Url: </strong>'.$val['publicUrl'];
	            			echo '</li>';
	            			echo '<li>';
	            			echo '<strong>Product Image: </strong>'.$val['imageSrc'];
	            			echo '</li>';
	            			if(isset($val['otherImages']) && !empty($val['otherImages'])){
	            				echo '<li>';
		            			echo "Available Images";
		            			echo '<ul>';
								foreach ($val['otherImages'] as $img) {
									echo '<li>';
									echo $img;
									echo '</li>';
								}
								echo '</ul>';
								echo '</li>';
							}
	            			echo '</ul>';
	            			echo '</li>';

	      //       			echo '<fieldset class="scheduler-border">';
	      //       			echo '<legend class="scheduler-border">Product Number: '.$key.'</legend>';
	      //       			echo '<div class="input-group mb-3">';
							// echo '<div class="input-group-prepend">';
							// echo '<span class="input-group-text">Product Title</span>';
							// echo '</div>';
							// echo '<input type="text" disabled="true" class="form-control" value="'.$val['title'].'">';
							// echo '</div>';
							// echo '<div class="input-group mb-3">';
							// echo '<div class="input-group-prepend">';
							// echo '<span class="input-group-text">Product Url</span>';
							// echo '</div>';
							// echo '<input type="text" disabled="true" class="form-control" value="'.$val['publicUrl'].'">';
							// echo '</div>';
							// echo '<div class="input-group mb-3">';
							// echo '<div class="input-group-prepend">';
							// echo '<span class="input-group-text">Product Image Src</span>';
							// echo '</div>';
							// echo '<input type="text" disabled="true" class="form-control" value="'.$val['imageSrc'].'">';
							// echo '</div>';

							// if(isset($val['otherImages']) && !empty($val['otherImages'])){
							// 	echo '<div class="input-group mb-3">';
							// 	echo '<div class="input-group-prepend">';
							// 	echo '<span class="input-group-text">Other Images</span>';
							// 	echo '</div>';
							// 	echo '<input type="text" disabled="true" class="form-control" value="'.implode(', ', $val['otherImages']).'">';
							// 	echo '</div>';
							// }

	      //       			echo '</fieldset>';
	            		}
	            	?>
	            	</ul>
	            </div>
	            <?php
	            	}
	            ?>
            </div>
        </div>
    </body>
</html>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script crossorigin="anonymous" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
</script>
<script crossorigin="anonymous" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
</script>
<script crossorigin="anonymous" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
</script>
<script defer="" type="text/javascript">
    $(document).ready(function(){
        		
        		$('#add-btn').click(function(){
        			var ele = '';
					ele += '<div class="input-group mb-3">';
					ele += '<input class="form-control product-number" placeholder="Enter product number" name="product_number[]" type="number">';
					ele += '<div class="input-group-append">';
					ele += '<span class="input-group-text remove-btn" title="Click to remove" style="cursor: pointer;">';
					ele += 'X';
					ele += '</span>';
					ele += '</div>';
					ele += '</input>';
					ele += '</div>';

        			$('#form-elements').append(ele);

        		});

        		$('#submit-btn').click(function(){
        			if(validate()){
        				$('#submit-form').submit();
        			}
        		});

        		$(document).on('click', '.remove-btn', function(){
        			$(this).closest('.input-group').remove();
        		});

        		function validate(){
        			var retVal = true;
        			var index = 1;
        			$('#form-elements').find('.product-number').each(function(){
        				var num = $(this).val();
        				if(typeof num === 'undefined'){
        					alert('Invalid input at ' + getSuffix(index) + ' row');
        					retVal = false;
        					return false;
        				}

        				if((Math.floor(num) != num) || !$.isNumeric(num)) {
        					retVal = false;
        					alert('Only numbers are allowed at ' + getSuffix(index) + ' row');
        					return false;
        				}
        				index++;
        			});
        			return retVal;
        		}

        		function getSuffix(i) {
				    var j = i % 10,
				        k = i % 100;
				    if (j == 1 && k != 11) {
				        return i + "st";
				    }
				    if (j == 2 && k != 12) {
				        return i + "nd";
				    }
				    if (j == 3 && k != 13) {
				        return i + "rd";
				    }
				    return i + "th";
				}

        	});
</script>
