<?php

namespace My\PrzepisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\PrzepisBundle\Entity\Images;
use My\PrzepisBundle\Entity\Przepis;
use My\PrzepisBundle\Entity\SkladnikPrzepisu;
use Symfony\Component\HttpFoundation\Request;
use My\PrzepisBundle\Helpers\Search;


class DefaultController extends Controller
{

    /**
     * @Route("/", name="index")
     * @Template()
     */
	public function indexAction(Request $request)
	{
		$form = $this->createFormBuilder()
				->add('szukaj', 'entity', array(
					'multiple' => true,
					'class' => 'MyPrzepisBundle:Skladnik',
					'label' => 'Wybierz składniki, na które masz ochote:',
					))
				->getForm();


    return array('form' => $form->createView()
    	);
	}
	/**
     * @Route("/searchform", name="search_form")
     * @Template()
     */
	public function SearchAction(Request $request)
	{
		$form = $this->createFormBuilder()
				->add('szukaj', 'entity', array(
					'multiple' => true,
					'class' => 'MyPrzepisBundle:Skladnik',
					))
				->getForm();


    return array('form' => $form->createView()
    	);
	}
	 /**
     * @Route("/results", name="search_results")
     * @Template("MyPrzepisBundle:Przepis:index.html.twig")
     */
	public function resultsAction(Request $request)
	{
		$form = $this->createFormBuilder()
				->add('szukaj', 'entity', array(
					'multiple' => true,
					'class' => 'MyPrzepisBundle:Skladnik',
					))
				->getForm();

				if ($request->isMethod('GET')) {
					$form->bind($request);
						$elements = '';
			            $data = $form->getData();
			            $data = $data['szukaj'];
			            $i=0;
			            foreach ($data as $d) {
			            	if ($i == 0){
			            		$elements = ' sp.skladnik = '.$d->getId();
			            		$i++;
			        		}
			        		else {
			        			$elements = $elements . ' OR sp.skladnik = '.$d->getId();
			        		}
			            }
						$em = $this->getDoctrine()->getEntityManager();
						$query = $em->createQuery(
						    'SELECT sp, count(sp) c FROM MyPrzepisBundle:SkladnikPrzepisu sp WHERE '.$elements.' GROUP BY sp.przepis HAVING c>0 ORDER BY c DESC'
						);
				}

				$products = $query->getResult();
		        return array(
		        		'entities' => $products
		        	);
	}
	}
	 /**
     * @Route("/test", name="test")
     * @Template("MyPrzepisBundle:Default:results.html.twig")
     */
	public function testAction(Request $request)
	{			
				$form = $this->createFormBuilder()
				->add('szukaj', 'entity', array(
					'multiple' => true,
					'class' => 'MyPrzepisBundle:Skladnik',
					))
				->getForm();

				if ($request->isMethod('GET')) {
					$form->bind($request);
						$elements = '';
			            $data = $form->getData();
			            $data = $data['szukaj'];
			            $i=0;
			            foreach ($data as $d) {
			            	if ($i == 0){
			            		$elements = ' sp.skladnik = '.$d->getId();
			            		$i++;
			        		}
			        		else {
			        			$elements = $elements . ' OR sp.skladnik = '.$d->getId();
			        		}
			            }
						$em = $this->getDoctrine()->getEntityManager();
						$query = $em->createQuery(
						    'SELECT sp, count(sp) c FROM MyPrzepisBundle:SkladnikPrzepisu sp WHERE '.$elements.' GROUP BY sp.przepis HAVING c>0 ORDER BY c DESC'
						);
				}

				$products = $query->getResult();
		        return array(
		        		'entities' => $products
		        	);
	}

}
