<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Notifications\Messages\MailMessage;

use App\Models\ContactEvent;
use \Carbon\Carbon;

class EmailNotificationController extends Controller
{
    public function sendMail()
    {
        $todayMMDD = Carbon::today()->format('m-d');
    //Cumpleaños
        $births = ContactEvent::where('data2', 'TYPE_BIRTHDAY')
                ->whereNull('data4')
                ->where(\DB::raw("substr(data1, 6,5)"),"=", $todayMMDD)
                ->get();

    $todaybirths = '';

    foreach ($births as $birth)
    {   
        $birthday = substr($birth->data1, 5,5);
        $name  = $birth->display_name; 
        $age   = $birth->age;
        $todaybirths .= $birthday .' ' .$name .' (' .$age .')<br>';
    }

    if (!empty($todaybirths)) {
        $to = 'danielkimmich@hotmail.com';
        $subject = 'Notificacion de Cumpleaños';
        $message = 'Estos son lo cumpleaños de la fecha<br>';
        $message .= $todaybirths .'<br>';
        $message .= 'Este es un correo automático de notificaciones';

/*
        Mail::raw($message, function ($mail) {
            // $mail->from('info@example.com');
            $mail->to('danielkimmich@hotmail.com');
            $mail->subject('Notificacion de Cumpleaños');
        });
*/
        Mail::send([], [], function($mail) use ($to, $subject, $message) {
            // $mail->from($data['from']);
            $mail->to($to);
            $mail->subject($subject);
            $mail->setBody($message, 'text/html');
        });

        if (Mail::failures()) {
         //   \Alert::info('Error al enviar correo')->flash(); 
            return 'Error al enviar correo';
        } else {
          //  \Alert::info('Notificacion por correo enviado')->flash();      
            return 'Notificacion por correo enviado';
        }
    } else {
      //  \Alert::info('No hay cumpleaños para hoy')->flash();
        return 'No hay cumpleaños para hoy';
    }

}


/*
    public function SendMail()
    {
		Mail::to('danielkimmich@hotmail.com')
    		//->cc($moreUsers)
    		->send(BirthdayList());

  		if (Mail::failures()) {
	        // return with failed message
	    } else {
			\Alert::info(trans('Notificacion por correo enviado'))->flash();	    	
	    }


		\Alert::info(trans('Notificacion por correo enviado'))->flash();
 
    }
*/
	public function toMailBirthday($notifiable)
	{
    	$url = url('/invoice/'.$this->invoice->id);

    	return (new MailMessage)
                ->greeting('Hello!')
                ->line('One of your invoices has been paid!')
                ->action('View Invoice', $url)
                ->line('Thank you for using our application!');
	}

    public function BirthdayList()
    {

        return (new MailMessage())
            ->subject('Notificacion de Cumpleaños')
            ->greeting('Cumpleaños de hoy')
            ->line([
                'persona_1',
                'persona_2',
            ])
           // ->action(trans('backpack::base.password_reset.button'), route('backpack.auth.password.reset.token', $this->token).'?email='.urlencode($email))
            ->line('no olvidar de felicitarlos');
    }

    //
}
