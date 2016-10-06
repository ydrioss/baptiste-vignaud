<?php

namespace YD\PortfolioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use YD\PortfolioBundle\Entity\Work;
use YD\PortfolioBundle\Entity\Image;

class LoadWork implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $imgUrlBase = "http://baptiste-vignaud.fr/images/work/";

    $urls = array(
      'bobard.png',
      'firefly.png',
      'tables.png',
      '23hbd.png',
      'monsieurpaul.png'
    );

    for ($i=0; $i <= 4 ; $i++) {
      $image[$i] = new Image();
      $image[$i]->setUrl($imgUrlBase . $urls[$i]);
    }

    $work1 = new Work();
    $work1->setTitle('Un bobard sur mesure');
    $work1->setCategory('Vidéo');
    $work1->setLink('https://vimeo.com/147320216');
    $work1->setContent("  <p>Film réalisé en groupe dans le cadre du cours de vidéo à l'Université de Valenciennes (3e année).</p>
							            <p>En collaboration avec Xavier Faudot, Fabian Bertèche et Jessica Maciejewsky.</p>
							            <p>Objectifs : réaliser un court métrage en passant par toutes les étapes de production : scénario, dialogue, storyboard, tournage, montage et mixage</p>
							            <p><a href=\"https://vimeo.com/147320216\">Cliquez ici pour voir le film.</a></p>"
    );
    $work1->setImage($image[0]);
    $manager->persist($work1);

    $work2 = new Work();
    $work2->setTitle('Firefly Onepage');
    $work2->setCategory('Web');
    $work2->setLink('http://baptiste-vignaud.fr/work/firefly/onepage.html');
    $work2->setContent("  <p>Onepage réalisée dans le cadre du cours d'intégration multimédia à l'Université de Limoges.</p>
							            <p>Objectifs : réaliser une onepage sur un sujet libre en HTML5, CSS3 et jQuery.</p>
							            <p><a href=\"firefly/onepage.html\">Cliquez ici pour voir la page.</a></p>"
    );
    $work2->setImage($image[1]);
    $manager->persist($work2);

    $work3 = new Work();
    $work3->setTitle('Les Tables Gourmandes');
    $work3->setCategory('Web');
    $work3->setLink('http://baptiste-vignaud.fr/work/tables_gourmandes/index.html');
    $work3->setContent("  <p>Site réalisé en groupe dans le cadre du cours d'intégration multimédia à l'Université de Limoges.</p>
							            <p>En collaboration avec Norma Michalik, Christian Petat, Mano Kim et Florence Germond</p>
							            <p>Objectifs : réaliser le site d'un restaurant d'après le logo fourni, et en respectant le cahier des charges fourni. Utiliser HTML5, CSS3 et jQuery.</p>
							            <p><a href=\"tables_gourmandes/index.html\">Cliquez ici pour voir le site.</a></p>"
    );
    $work3->setImage($image[2]);
    $manager->persist($work3);

    $work4 = new Work();
    $work4->setTitle('Les 23 heures de la BD');
    $work4->setCategory('BD');
    $work4->setLink('https://www.23hbd.com/?pg=participation&pt=1835&an=2015');
    $work4->setContent("  <p>Inspiré des 24 heures de la BD (organisées à l'origine aux États-Unis par Scott McCloud et apportées en France par Lewis Trondheim lors du Festival d'Angoulême 2007), les 23 heures de la BD sont un marathon organisé par Turalo et l'Atelier Pop de Tours.</p>
							            <p>Le principe : tous les ans, au passage à l'heure d'été, les participants ont 23h (du samedi 13h au dimanche 13h) pour réaliser 22 planches et la première et dernière de couverture. Chaque année avec un nouveau thème et une nouvelle contrainte.</p>
							            <p>J'y participe en équipe depuis 2013, en collaboration avec Jofer-KK, LeBob et Eerji.</p>
            							<ul>
            								<li><a href=\"http://www.23hbd.com/?pg=participation&pt=1835&an=2015\">2015 - La relique de K'aad'em'ylh</a> (thème : les naufragés ; contrainte : un caméo de David Hasselhoff portant un t-shirt &quot;I &lt;3 Piak&quot;)</li>
            								<li><a href=\"http://www.23hbd.com/?pg=participation&pt=413&an=2014\">2014 - Flageolets et flagellation</a> (thème : famille nombreuse ; contrainte : seuls les animaux -non humains- ont le droit de parler)</li>
            								<li><a href=\"http://www.23hbd.com/?pg=participation&pt=354&an=2013\">2013 - La Tarte au poils</a> (thème : la cohabitation ; contrainte : au moins un grand chapeau ridicule)</li>
            							</ul>"
    );
    $work4->setImage($image[3]);
    $manager->persist($work4);

    $work5 = new Work();
    $work5->setTitle('Monsieur Paul');
    $work5->setCategory('Illustration - Mise en page');
    $work5->setLink('http://baptiste-vignaud.fr/work/monsieurpaul.pdf');
    $work5->setContent("  <p>Livre réalisé dans le cadre d'un Workshop à l'ESIAJ.</p>
							            <p>Objectif : créer un livre dans son ensemble (histoire, illustration, mise en page, reliure) en se basant sur un végétal au choix.</p>
							            <p>Ici, nous avons choisi la citrouille, et pris le parti de faire une parodie de livre pour enfant.</p>
							            <p>En collaboration avec Pierre Le Brun.</p>
							            <p><a href=\"monsieurpaul.pdf\">Cliquez ici pour voir le livre en pdf.</a></p>"
    );
    $work5->setImage($image[4]);
    $manager->persist($work5);

    $manager->flush();

  }
}
