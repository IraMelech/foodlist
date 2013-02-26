<?php

namespace My\PrzepisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\PrzepisBundle\Entity\Document;
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
     * @Template()
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

	            $data = $form->getData();
	            $data = $data['szukaj'];
	            $search = new Search;
	            $results = $search->search($data);

	            
				return array(
					'results' => $results,
		            'data' => $data,
		        );	
		        }
	}

}
