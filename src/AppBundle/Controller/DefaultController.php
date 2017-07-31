<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Services\LinkCreator;
use AppBundle\Services\VisitRegistrator;
use DateTime;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    /**
     * @var LinkCreator
     */
    private $linkCreator;

    /**
     * @var VisitRegistrator
     */
    private $visitRegistrator;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * DefaultController constructor.
     * @param LinkCreator      $linkCreator
     * @param VisitRegistrator $visitRegistrator
     * @param EntityManager    $entityManager
     * @param Serializer       $serializer
     */
    public function __construct(
        LinkCreator $linkCreator,
        VisitRegistrator $visitRegistrator,
        EntityManager $entityManager,
        Serializer $serializer
    ) {
        $this->linkCreator = $linkCreator;
        $this->visitRegistrator = $visitRegistrator;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/create/", name="createLink")
     * @Method({"POST"})
     */
    public function createTinylink(Request $request)
    {
        $originalLink = $request->get('link');

        if (empty($originalLink)) {
            throw  new NotFoundHttpException();
        }

        $expiredDateParam = $request->get('expiredDate');

        /**
         * @todo иначе реализовать валидацию
         */
        $expiredDate = null;
        if (!empty($expiredDateParam)) {
            $expiredDate = DateTime::createFromFormat('Y-m-d', $expiredDateParam);
            if ($expiredDate === false) {
                throw new Exception('Incorrect date format');
            }
        }

        $link = $this->linkCreator->create($originalLink, $expiredDate);

        /**
         * @todo компоновку ссылок вынести в сервис
         */
        $response = new JsonResponse([
            'tinyLink' => $request->getHost().'/'.$link->getTiny(),
            'statisticLink' => $request->getHost().'/statistic/'.$link->getTiny(),
        ]);
        $response->setEncodingOptions(JSON_UNESCAPED_SLASHES);

        return $response;
    }

    /**
     * @Route("/{tinyLink}", name="redirect")
     */
    public function redirectToFull(string $tinyLink, Request $request)
    {
        $link = $this->getLink($tinyLink);

        $this->visitRegistrator->register($link);

        return new RedirectResponse($link->getOriginal(), RedirectResponse::HTTP_MOVED_PERMANENTLY);
    }

    /**
     * @Route("/statistic/{tinyLink}", name="statistic")
     */
    public function getStatistic(string $tinyLink, Request $request)
    {
        $link = $this->getLink($tinyLink);

        /**
         * @todo сделать нормлаьный сериалайз а не это...
         * пока оставлю так из за проблемы с энкодером
         */
        $linkVisits = $link->getVisits()->getValues();

        $newLinks = [];
        foreach ($linkVisits as $visit) {
            $newLinks[] = [
                'geo' => $visit->getGeo(),
                'userAgent' => $visit->getUserAgent(),
                'visitTime' => $visit->getVisitTime(),
            ];
        }

        $response = new JsonResponse([
            'linkVisits' => $newLinks,
            'link' => [
                'original' => $link->getOriginal(),
                'tinyCode' => $link->getTiny(),
            ],
        ]);
        $response->setEncodingOptions(JSON_UNESCAPED_SLASHES);

        return $response;
    }

    /**
     * Получаем ссылку по короткой иначе выбрасываем исключения(вынес в метод чтобы убить дубляж)
     *
     * @param $tinyLink
     * @return Link
     */
    private function getLink(string $tinyLink): Link
    {
        if (empty($tinyLink)) {
            throw  new NotFoundHttpException();
        }

        $link = $this->entityManager->find(Link::class, $tinyLink);

        if (empty($link)) {
            throw  new NotFoundHttpException();
        }

        return $link;
    }
}
