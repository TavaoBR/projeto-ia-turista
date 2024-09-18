<?=$this->layout('themas/site', ['title' => $title]);?>

<link href="<?=Assests("/")?>assets/css/resultado.css" rel="stylesheet">

<section id="resume" class="resume">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
          <h2>Resultado</h2>
          <p>Aqui está o roteiro para conhecer <?=$array['Destino']?></p>
        </div>

        <div class="row">
          <div class="col-lg-16">
            <h3 class="resume-title"><?=$array['Nome']?></h3>
            <div class="resume-item pb-0">
              <h4>Seu Roteiro</h4>
              <p><em><?=$array['Destino']?></em></p>
              <p>
              </p>
              <p><em><?=$array['Está indo ?']?></em></p>
              <p></p>
              <p><em><?=$array['Passeios']?></em></p>
              <p></p>
              <p><em><?=str_replace("*", " ", $array['Roteiro'])?></em></p>
            </div>
          </div>
        </div>

      </div>
    </section>