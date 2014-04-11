<?php

use Programs\Parkcms\Workshop\Models\Workshop;
use Programs\Parkcms\Workshop\Models\Part;
use Programs\Parkcms\Workshop\Models\Registration;

class WorkshopSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $w1 = Workshop::create(array(
            'identifier' => 'workshop',
            'title' => '1st Workshop',
            'content' => '',
            'terms' => '1. Workshop Organizer; Participants; Hotel reservations
The workshop is organized by:

Dr. med. Klaus Ueberreiter
Abteilung für Plastische und Ästhetische Chirurgie
Asklepios Klinik Birkenwerder
Hubertusstraße 12-22, D-16547 Birkenwerder
E-Mail : k.ueberreiter@asklepios.com

The workshop is intended for education of physicians. Only a limited number of accompanying persons will be accepted. In case of doubt, please contact the organizer in advance.
If hotel reservations are made on behalf of a registrant, the organizer only acts as service party. The contract is generated between registrant and hotel, and hotel costs will be paid by the participant in full.

2. Confirmation of Registration; Right to Refuse
The preferred way of registration is via this Internet page. Any registration has to be confirmed by the organizer to become effective. The preferred way of communication is electronic mail. The organizer preserves the right to refuse any registration for any reason. In case refusal of registration the transferred amount will be transferred back in full.

3. Payments
The workshop fee includes meals, welcome reception, congress material, participation certificate and dinner cruise and is valid until June 5th, 2010 (deadline for online registration).
All fees have to be paid by the registrant in full and in advance via PayPal online payment system, as offered on this website. Full payment is a prerequisite for a successful workshop registration.
In case refusal of registration, workshop cancellation or cancellation by the registrant the money will be transferred back, if applicable minus a cancellation fee, without any unreasonable delay.

4. Cancellation
The organizer preserves the right to cancel the workshop in case of too few participants and/or other important reasons. A cancellation because of too few participants would have to be announced by May 29th,2010. In any case of workshop cancellation, all paid fees will be transferred back in full.
The organizer does not assume any liability for other costs in connection with a workshop cancellation.
The registrant has the right to cancel his or her participation.',
            'registration_mail' => 'friedrich@ueberreiter.com',
            'registration_mail_body' => 'Thank you for registration',
            'date' => new \DateTime('-1 month'),
            'seats' => '50',
            'active' => '0'
        ));
        $w2 = Workshop::create(array(
            'identifier' => 'workshop',
            'title' => '2nd Workshop',
            'content' => '',
            'terms' => '1. Workshop Organizer; Participants; Hotel reservations
The workshop is organized by:

Dr. med. Klaus Ueberreiter
Abteilung für Plastische und Ästhetische Chirurgie
Asklepios Klinik Birkenwerder
Hubertusstraße 12-22, D-16547 Birkenwerder
E-Mail : k.ueberreiter@asklepios.com

The workshop is intended for education of physicians. Only a limited number of accompanying persons will be accepted. In case of doubt, please contact the organizer in advance.
If hotel reservations are made on behalf of a registrant, the organizer only acts as service party. The contract is generated between registrant and hotel, and hotel costs will be paid by the participant in full.

2. Confirmation of Registration; Right to Refuse
The preferred way of registration is via this Internet page. Any registration has to be confirmed by the organizer to become effective. The preferred way of communication is electronic mail. The organizer preserves the right to refuse any registration for any reason. In case refusal of registration the transferred amount will be transferred back in full.

3. Payments
The workshop fee includes meals, welcome reception, congress material, participation certificate and dinner cruise and is valid until June 5th, 2010 (deadline for online registration).
All fees have to be paid by the registrant in full and in advance via PayPal online payment system, as offered on this website. Full payment is a prerequisite for a successful workshop registration.
In case refusal of registration, workshop cancellation or cancellation by the registrant the money will be transferred back, if applicable minus a cancellation fee, without any unreasonable delay.

4. Cancellation
The organizer preserves the right to cancel the workshop in case of too few participants and/or other important reasons. A cancellation because of too few participants would have to be announced by May 29th,2010. In any case of workshop cancellation, all paid fees will be transferred back in full.
The organizer does not assume any liability for other costs in connection with a workshop cancellation.
The registrant has the right to cancel his or her participation.',
            'registration_mail' => 'friedrich@ueberreiter.com',
            'registration_mail_body' => 'Thank you for registration',
            'date' => new \DateTime('+1 month'),
            'seats' => '50',
            'active' => '1'
        ));

        $w1->parts()->save(new Part(array(
            'title' => 'Workshop',
            'description' => '',
            'price' => 59.95,

            'part_type' => 1,
            'select_values' => '',

            'connected_with_seats' => true,
            'order' => 1
        )));
        $w1->parts()->save(new Part(array(
            'title' => 'Evening program',
            'description' => '',
            'price' => 29.95,

            'part_type' => 1,
            'select_values' => '',

            'connected_with_seats' => false,
            'order' => 2
        )));


        $w2->parts()->save(new Part(array(
            'title' => 'Workshop',
            'description' => '',
            'price' => 59.95,

            'part_type' => 1,
            'select_values' => '',

            'connected_with_seats' => true,
            'order' => 1
        )));
        $w2->parts()->save(new Part(array(
            'title' => 'Evening program',
            'description' => 'How many will come?',
            'price' => 29.95,

            'part_type' => 2,
            'select_values' => '0,1,2',

            'connected_with_seats' => false,
            'order' => 2
        )));
    }
}