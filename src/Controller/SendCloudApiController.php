<?php

declare(strict_types=1);

namespace cdigruttola\Sendcloudapi\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SendCloudApiController extends FrameworkBundleAdminController
{
    /** @var array */
    private $languages;
    /** @var \Module */
    private $module;

    public function __construct($languages, $module)
    {
        parent::__construct();
        $this->languages = $languages;
        $this->module = $module;

    }

    public function index(): Response
    {
        $configurationForm = $this->get('cdigruttola.sendcloudapi.configuration.form_handler')->getForm();

        return $this->render('@Modules/sendcloudapi/views/templates/admin/index.html.twig', [
            'configurationForm' => $configurationForm->createView(),
            'module_dir' => _MODULE_DIR_ . $this->module->name . '/',
            'url_tracking' => \Context::getContext()->link->getModuleLink($this->module->name, 'tracking'),
            'help_link' => false,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function saveConfiguration(Request $request): Response
    {
        $redirectResponse = $this->redirectToRoute('sendcloudapi_controller');

        $form = $this->get('cdigruttola.sendcloudapi.configuration.form_handler')->getForm();
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return $redirectResponse;
        }

        if ($form->isValid()) {
            $data = $form->getData();
            $saveErrors = $this->get('cdigruttola.sendcloudapi.configuration.form_handler')->save($data);

            if (0 === count($saveErrors)) {
                $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

                return $redirectResponse;
            }
        }

        $formErrors = [];

        foreach ($form->getErrors(true) as $error) {
            $formErrors[] = $error->getMessage();
        }

        $this->flashErrors($formErrors);

        return $redirectResponse;
    }
}
