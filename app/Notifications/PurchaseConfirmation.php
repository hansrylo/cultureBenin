<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseConfirmation extends Notification
{
    use Queueable;

    protected $paiement;
    protected $achat;

    /**
     * Create a new notification instance.
     */
    public function __construct($paiement, $achat)
    {
        $this->paiement = $paiement;
        $this->achat = $achat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Confirmation de votre achat - Miwakpon Bénin')
            ->greeting('Bonjour ' . $notifiable->prenom . ',')
            ->line('Nous vous confirmons l\'achat de l\'article suivant :')
            ->line('**Article :** ' . $this->paiement->contenu->titre)
            ->line('**Montant :** ' . $this->paiement->montantFormate())
            ->line('**Référence :** #' . $this->paiement->id_paiement)
            ->line('Vous pouvez dès maintenant accéder à cet article en cliquant sur le bouton ci-dessous.')
            ->action('Lire l\'article', route('contenu.public.show', $this->paiement->contenu->id_contenu))
            ->line('Retrouvez tous vos achats dans la section "Mes Achats" de votre compte.')
            ->line('Merci de votre confiance !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'paiement_id' => $this->paiement->id_paiement,
            'contenu_id' => $this->paiement->contenu->id_contenu,
            'montant' => $this->paiement->montant,
        ];
    }
}
