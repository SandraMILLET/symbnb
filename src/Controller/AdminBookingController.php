<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("/admin/bookings/{page<\d+>?1}", name="admin_booking_index")
     */
    public function index(BookingRepository $repo, $page)
    {
        $limit = 10;
        $start = $page * $limit - $limit;
        $total = count($repo->findAll());
        $pages = ceil($total / $limit);

        return $this->render('admin/booking/index.html.twig', [
            'bookings' => $repo->findAll(),
            'pages' => $pages,
            'page' => $page
        ]);
    }

    /**
     * Permet d'éditer une réservation
     * @Route("admin/bookings/{id}/edit", name="admin_booking_edit")
     * @return Response
     */
    public function edit(Booking $booking, Request $request){
        $form =$this->createForm(AdminBookingType::class, $booking);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($booking);
            $manager->flush();
            $this->addFlash(
                'success',
                "La réservation <strong>{$ad->getTitle()}</strong> a bien été enregistré !"
            );
        }

        return $this->render('admin/ad/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView()
        ]);
    }
}
