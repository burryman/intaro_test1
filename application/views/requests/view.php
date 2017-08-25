<?php
echo $requests_item['phone'];
echo $requests_item['description'];?>
<div class = "img" style="background-image:url(<?php echo base_url().$requests_item['image_url']?>)">
	<img class = "hidden_img" src="<?php echo base_url().$requests_item['image_url']?>" style="visibility: hidden; max-width: 100%" />
</div>