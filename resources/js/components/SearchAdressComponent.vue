<template>
    <div>
        <label>Adresse</label>
        <input id="address" type="search" placeholder="" ref="addressInput" :value="data">
    </div>
</template>

<script>
import {onMounted, ref, watch} from 'vue';
export default {
    emits: ['addressCity', 'addressCountry', 'addressStreet', 'addressPostalCode'],
    props: {
        data: String,
    },
    setup(_, {emit}) {
        const addressInput = ref(null);
        const address = ref({
            number: "",
            street: '',
            city: '',
            country: '',
            postal_code: '',
        });


        // onMounted(async  () => {
        //     const link = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCTCgHPyklKUafE6iglmnEeyitc2FrI5QE&libraries=places";
        //
        //     await new Promise((resolve, reject) => {
        //         let googleScript = document.querySelector(`script[src="${link}"]`);
        //         if (!googleScript) {
        //             googleScript = document.createElement('script');
        //             googleScript.src = link;
        //             googleScript.async = true;
        //
        //             googleScript.addEventListener('error', () => {
        //                 reject();
        //             });
        //
        //             googleScript.addEventListener('load', () => {
        //                 resolve();
        //             });
        //
        //             document.head.append(googleScript);
        //         } else {
        //             resolve();
        //         }
        //     });
        //
        //     // Wait for next tick to ensure the component is fully mounted
        //     await new Promise((resolve) => {
        //         setTimeout(resolve, 0);
        //     });
        //
        //     const autocomplete = new google.maps.places.Autocomplete(addressInput.value);
        //
        //     autocomplete.addListener('place_changed', () => {
        //         const place = autocomplete.getPlace();
        //         console.log(place, 'place');
        //         if (place) {
        //             let street = true;
        //             const addressComponents = place.address_components;
        //             addressComponents.forEach(component => {
        //                 const types = component.types;
        //                 if (types[0].includes('street_number')) {
        //                     address.number = component.long_name;
        //                     street = false;
        //                 }
        //                 if(street){
        //                     address.number = " ";
        //                     street = false;
        //                 }
        //                 if (types[0].includes('route')) {
        //                     address.street = `${address.number} ${component.long_name}`;
        //                 }
        //
        //                 if (types[0].includes('locality')) {
        //                     address.city = component.long_name;
        //                 }
        //
        //                 if (types[0].includes('country')) {
        //                     address.country = component.long_name;
        //                 }
        //                 if (types[0].includes('postal_code')) {
        //                     address.postal_code = component.long_name;
        //                 }
        //             });
        //             console.log(address.country);
        //             console.log(address.street);
        //             console.log(address.postal_code);
        //             emit('addressStreet', address.street);
        //             emit('addressCountry', address.country);
        //             emit('addressPostalCode', address.postal_code);
        //             emit('addressCity', address.city);
        //         }
        //     });
        // });

        return {
            address,
            addressInput,
        };
    },
};
</script>

<style scoped>
div {
    display: flex;
    flex-direction: column;
}
input{
    border: none;
    border-radius: 20px;
    font-size: 1.2rem;
    padding: 0.5rem;
    width: 100%;
    color: #555;
    background-color: transparent;
    transition: all 0.3s ease;
    box-shadow: 0 0 0 2px #ddd;
    font-family: Lato, sans-serif;
}
label{
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #333;
    margin-left: 10px;
    font-family: Lato, sans-serif;
}

input:focus{
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}
</style>
