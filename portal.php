
<style>
	header.masthead{
		background-image: url('<?php echo validate_image($_settings->info('cover')) ?>') !important;
	}
	header.masthead .container{
		background:#0000006b;
	}
</style>
<!-- Masthead-->

<header class="masthead">
	<div class="container">
		<!-- Tentando meter um carrossel --> <div class="masthead-subheading text-white text-uppercase" id="Texto" > </div>
		<div class="masthead-heading text-uppercase">MARAVILHA-TE</div>

	</div>
</header>

<!-- Services-->

<section class="page-section bg-dark"  id="home">
	<div class="container">
		<h2 class="text-center btn btn-secondary text-uppercase">Pacotes turisticos</h2>
	<div class="d-flex w-100 justify-content-center">
		
	</div>
	<div class="row bg-secondary">
		<?php
		$packages = $conn->query("SELECT * FROM `packages` order by rand() limit 3");
			while($row = $packages->fetch_assoc() ):
				$cover='';
				if(is_dir(base_app.'uploads/package_'.$row['id'])){
					$img = scandir(base_app.'uploads/package_'.$row['id']);
					$k = array_search('.',$img);
					if($k !== false)
						unset($img[$k]);
					$k = array_search('..',$img);
					if($k !== false)
						unset($img[$k]);
					$cover = isset($img[2]) ? 'uploads/package_'.$row['id'].'/'.$img[2] : "";
				}
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));

				$review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}'");
				$review_count =$review->num_rows;
				$rate = 0;
				while($r= $review->fetch_assoc()){
					$rate += $r['rate'];
				}
				if($rate > 0 && $review_count > 0)
				$rate = number_format($rate/$review_count,0,"");
		?>
			<div class="col-md-4 p-4 bg-light"  style=" border-radius: 40px;">
				<div class="card w-100 rounded-0 bg-dark text-white">
					<img class="card-img-top" src="<?php echo validate_image($cover) ?>" alt="<?php echo $row['title'] ?>" height="200rem" style="object-fit:cover">
					<div class="card-body text-white">
					<h5 class="card-title truncate-1 w-100 text-white text-uppercase"><?php echo $row['title'] ?></h5><br>
					<div class=" w-100 d-flex justify-content-start">
						<div class="stars stars-small">
								<input disabled class="star star-5" id="star-5" type="radio" name="star" <?php echo $rate == 5 ? "checked" : '' ?>/> <label class="star star-5" for="star-5"></label> 
								<input disabled class="star star-4" id="star-4" type="radio" name="star" <?php echo $rate == 4 ? "checked" : '' ?>/> <label class="star star-4" for="star-4"></label> 
								<input disabled class="star star-3" id="star-3" type="radio" name="star" <?php echo $rate == 3 ? "checked" : '' ?>/> <label class="star star-3" for="star-3"></label> 
								<input disabled class="star star-2" id="star-2" type="radio" name="star" <?php echo $rate == 2 ? "checked" : '' ?>/> <label class="star star-2" for="star-2"></label> 
								<input disabled class="star star-1" id="star-1" type="radio" name="star" <?php echo $rate == 1 ? "checked" : '' ?>/> <label class="star star-1" for="star-1"></label> 
						</div>
                    </div>
    				<p class="card-text truncate text-white"><?php echo $row['description'] ?></p>
					<div class="w-100 d-flex justify-content-end ">
						<a   class="btn btn-sm btn-flat text-uppercase btn-secondary" style=" border-radius: 150px;" <a href="./?page=view_package&id=<?php echo md5($row['id']) ?>" class="btn btn-dark  align-items-center">consultar</a>
					</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>

	<div class="d-flex w-100 justify-content-end">
		<a href="./?page=packages"  class="btn btn-secondary text-uppercase mr-4">mais pacotes</a>
	</div>
	</div>
</section>
<!-- About-->
<section class="page-section " id="about">
	<div class="container">
		<div class="text-center navbar navbar-expand-lg bg-dark text-white navbar-shrink">
			<h2 class=" text-center section-heading text-uppercase btn btn-secondary  ">Sobre O Tour Ang</h2>
		</div>
		<div>
			<div class="card w-100 bg text-white">
				<div class="card-body bg-secondary">
					<?php echo file_get_contents(base_app.'about.html') ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Contact-->
<section class="page-section bg-dark" id="contact" >
	<div class="container">
		<div class="text-center">
			<h2 class="section-heading text-uppercase btn btn-dark">Fale conosco</h2>
			<h3 class="section-subheading text-muted">Deixe um Recado</h3>
		</div>
		<!-- * * * * * * * * * * * * * * *-->
		<!-- * * SB Forms Contact Form * *-->
		<!-- * * * * * * * * * * * * * * *-->
		<!-- This form is pre-integrated with SB Forms.-->
		<!-- To make this form functional, sign up at-->
		<!-- https://startbootstrap.com/solution/contact-forms-->
		<!-- to get an API token!-->

		<form id="contactForm " >
			<div class="row align-items-stretch mb-5">
				<div class="col-md-6">
					<div class="form-group">
						<!-- Name input-->
						<input class="form-control" id="name" name="name" type="text" placeholder="NOME *" required />
					</div>
					<div class="form-group">
						<!-- Email address input-->
						<input class="form-control" id="email" name="email" type="email" placeholder="SEU EMAIL *" data-sb-validations="required,email" />
					</div>
					<div class="form-group mb-md-0">
						<input class="form-control" id="subject" name="assunto" type="subject" placeholder="ASSUNTO *" required />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-group-textarea mb-md-6">
						<!-- Message input-->
						<textarea class="form-control" id="message" name="message" placeholder="SEU RECADO *" required></textarea>
					</div>
				</div>
			</div>
			<div class="text-center"><button class="btn btn-secondary btn-xl text-uppercase" id="submitButton" type="submit" style=" border-radius: 150px;">ENVIAR</button></div>
		</form>
	</div>
</section>
<script>
$(function(){
	$('#contactForm').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:_base_url_+"classes/Master.php?f=save_inquiry",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("ops, algo deu errado",'erro')
				end_loader()
			},
			success:function(resp){
				if(typeof resp == 'object' && resp.status == 'success'){
					alert_toast("Mensagem enviada")
					$('#contactForm').get(0).reset()
				}else{
					console.log(resp)
					alert_toast("ocorreu um erro")
					end_loader()
				}
			}
		})
	})
})

const el = document.querySelector("#Texto")  
    const text = ` Bem Vindo ao Tour Ang`;
    const interval = 300
    

    function showText (el, text, interval) {
        const char = text.split("").reverse();

        const typer = setInterval( () => {
            
        //checando se ainda tem letra ou não
            if(!char.length){
                return clearInterval(typer)
            }

        //chamando cada caracter(começando do último)
        const next = char.pop()
        
        el.innerHTML += next;
        el.style.color="blue";

        }, interval)

    }

    showText(el, text, interval)

</script>