<?php

namespace Ds\Bundle\AccountUserPersonaBundle\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class PersonaController
 *
 * @Route("/persona")
 */
class PersonaController extends Controller
{
    /**
     * Index action
     *
     * @Route("s")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $manager = $this->get('ds.userpersona.manager.persona');
        $personas = $manager->getList(null, null, [ 'user' => $user ]);

        return [
            'personas' => $personas
        ];
    }

    /**
     * View action
     *
     * @param string $slug
     * @return array
     * @Route("/{slug}")
     * @Template()
     */
    public function viewAction($slug)
    {
        $user = $this->getUser();

        $manager = $this->get('ds.userpersona.manager.definition');
        $definitions = $manager->getList(1, 1, [ 'slug' => $slug ]);
        $definition = array_shift($definitions);

        $manager = $this->get('ds.userpersona.manager.persona');
        $personas = $manager->getList(1, 1, [ 'user' => $user, 'definition' => $definition ]);
        $persona = array_shift($personas);

        $manager = $this->get('ds.asset.manager.asset');
        $assets = $manager->getList(null, null, [ 'user' => $user ]);

        return [
            'persona' => $persona,
            'assets' => $assets
        ];
    }

    /**
     * Edit action
     *
     * @param string $slug
     * @return array
     * @Route("/{slug}/form")
     * @Template()
     */
    public function editAction($slug)
    {
        $user = $this->getUser();

        $manager = $this->get('ds.userpersona.manager.definition');
        $definitions = $manager->getList(1, 1, [ 'slug' => $slug ]);
        $definition = array_shift($definitions);

        $manager = $this->get('ds.userpersona.manager.persona');
        $personas = $manager->getList(1, 1, [ 'user' => $user, 'definition' => $definition ]);
        $persona = array_shift($personas);

        $request = $this->get('request');
        $data = (array) $persona->getData();
        $form = $this->createForm('ds_userpersona_persona_data', $data, [ 'persona' => $persona ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $persona->setData((object) $data);
            $om = $manager->getObjectManager();
            $om->persist($persona);
            $om->flush();

            if ($request->query->get('redirect')) {
                return $this->redirect($request->query->get('redirect'));
            } else {
                return $this->redirectToRoute('ds_accountuserpersona_account_persona_index');
            }
        }

        return [
            'persona' => $persona,
            'form' => $form->createView()
        ];
    }
}
