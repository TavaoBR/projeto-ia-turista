<?=$this->layout('themas/site', ['title' => $title]);
$cidade = $array['Destino'];
?>

<link href="<?=Assests("/")?>assets/css/resultado.css" rel="stylesheet">

<section id="resume" class="resume">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
          <h2>Resultado</h2>
          <p>Aqui está o roteiro para conhecer <?=strstr($cidade, '-', true)?></p>
        </div>

        <div class="row">
          <div class="col-lg-16">
            <div class="resume-item pb-0">
              <p><em><?=str_replace("*", " ", $array['Roteiro'])?></em></p>
            </div>
          </div>
        </div>

      </div>
    </section>