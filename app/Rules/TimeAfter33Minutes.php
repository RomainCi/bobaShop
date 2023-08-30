<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class TimeAfter33Minutes implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Obtenir l'heure actuelle à Paris
        $now = Carbon::now(new \DateTimeZone('Europe/Paris'));
        // Ajouter 26 minutes à l'heure actuelle
        $minTimeAfter26Minutes = $now->addMinutes(26);
        // Convertir l'heure entrée en objet Carbon
//       dd($minTimeAfter33Minutes);
        $inputTime = Carbon::createFromFormat('H:i', $value, new \DateTimeZone('Europe/Paris'));
//        dd($inputTime,$minTimeAfter26Minutes);

        return true;
//        dd($inputTime->greaterThan($minTimeAfter33Minutes));
//dd($inputTime);
        // Vérifier si l'heure entrée est supérieure à 33 minutes par rapport à l'heure actuelle
        return $inputTime->greaterThanOrEqualTo($now->copy()->setHour(11)->setMinute(30))
            && $inputTime->greaterThanOrEqualTo($minTimeAfter26Minutes)
            && $inputTime->lessThanOrEqualTo($now->copy()->setHour(18)->setMinute(30));
    }

    /**
     * Get the validation error message.
     *
     *
     */
    public function message(): string
    {
        return "Erreur avec l'heure de récupération";

    }
}
