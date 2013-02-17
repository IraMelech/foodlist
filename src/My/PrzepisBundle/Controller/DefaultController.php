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
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    /**
     * @Route("/test", name="test")
     * @Template()
     */
	public function testAction(Request $request)
	{
		$form = $this->createFormBuilder()
				->add('nazwa', 'text')
				->add('szukaj', 'entity', array(
					'multiple' => true,
					'class' => 'MyPrzepisBundle:Skladnik',
					))
				->getForm();



    return array('form' => $form->createView()
    	);
	}
	    /**
     * @Route("/test2", name="test2")
     * @Template()
     */
	public function test2Action(Request $request)
	{
		$form = $this->createFormBuilder()
				->add('nazwa', 'text')
				->add('szukaj', 'entity', array(
					'multiple' => true,
					'class' => 'MyPrzepisBundle:Skladnik',
					))
				->getForm();
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
		        if ($form->isValid()) {

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
}
