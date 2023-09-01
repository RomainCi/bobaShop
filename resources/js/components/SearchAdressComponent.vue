<template>
    <div>
        <label>Adresse *</label>
        <input id="address" type="search" placeholder="" ref="addressInput" :value="data">
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { Loader } from '@googlemaps/js-api-loader';

export default {
    emits: ['addressCity', 'addressCountry', 'addressStreet', 'addressPostalCode'],
    props: {
        data: String,
    },
    setup(_, { emit }) {
        const addressInput = ref(null);
        const address = ref({
            number: "",
            street: '',
            city: '',
            country: '',
            postal_code: '',
        });

        onMounted(async () => {
            const loader = new Loader({
                apiKey: 'AIzaSyCTCgHPyklKUafE6iglmnEeyitc2FrI5QE',
                version: 'weekly',
                libraries: ['places'],
            });

            try {
                await loader.load();
                const autocomplete = new google.maps.places.Autocomplete(addressInput.value);

                autocomplete.addListener('place_changed', () => {
                    const place = autocomplete.getPlace();
                    console.log(place, 'place');
                    if (place) {
                        let street = true;
                        const addressComponents = place.address_components;
                        addressComponents.forEach(component => {
                            const types = component.types;
                            if (types[0].includes('street_number')) {
                                address.number = component.long_name;
                                street = false;
                            }
                            if (street) {
                                address.number = " ";
                                street = false;
                            }
                            if (types[0].includes('route')) {
                                address.street = `${address.number} ${component.long_name}`;
                            }

                            if (types[0].includes('locality')) {
                                address.city = component.long_name;
                            }

                            if (types[0].includes('country')) {
                                address.country = component.long_name;
                            }
                            if (types[0].includes('postal_code')) {
                                address.postal_code = component.long_name;
                            }
                        });
                        emit('addressStreet', address.street);
                        emit('addressCountry', address.country);
                        emit('addressPostalCode', address.postal_code);
                        emit('addressCity', address.city);
                    }
                });
            } catch (error) {
                console.error('Error loading Google Maps API:', error);
            }
        });

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
input[type="search"]{
    border: none;
    border-radius: 6px;
    font-size: 1.2rem;
    padding: 0.5rem;
    width: 100%;
    color: white;
    background-color: #EAB99F;
    transition: all 0.3s ease;
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

input[type="search"]:focus{
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}
</style>
