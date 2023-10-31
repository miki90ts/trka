<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const props = defineProps({
    profile: {
        type: Object,
    },
    countries: {
        type: Array,
    },
    genders: {
        type: Array,
    },
    shirtSizes: {
        type: Array,
    },
});

const form = useForm({
    gender: props.profile.gender ?? "",
    birthday: props.profile.birthday ?? "",
    phone: props.profile.phone ?? "",
    address: props.profile.address ?? "",
    city: props.profile.city ?? "",
    postal_code: props.profile.postal_code ?? "",
    country_id: props.profile.country_id ?? "162",
    club: props.profile.club ?? "",
    shirt_size_id: props.profile.shirt_size_id ?? "",
    emergency_phone: props.profile.emergency_phone ?? "",
});

const format = (date) => {
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update.profile'))"
            class="mt-6 space-y-6"
        >
            <div class="mt-4">
                <InputLabel
                    for="phone"
                    :required="true"
                    :value="__('auth.phone')"
                />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                    autocomplete="phone"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="birthday"
                    :required="true"
                    :value="__('auth.birthday')"
                />

                <VueDatePicker
                    v-model="form.birthday"
                    auto-apply
                    :enable-time-picker="false"
                    :format="format"
                    :max-date="new Date()"
                    required
                ></VueDatePicker>

                <InputError class="mt-2" :message="form.errors.birthday" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="gender"
                    :required="true"
                    :value="__('auth.gender')"
                />

                <SelectInput
                    v-model="form.gender"
                    keyIndex="value"
                    valueIndex="value"
                    labelIndex="label"
                    :data="genders"
                    id="gender"
                    class="mt-1 block w-full"
                    required
                    :show-choose="true"
                ></SelectInput>

                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="shirt_size_id"
                    :required="true"
                    :value="__('auth.shirt_size')"
                />

                <SelectInput
                    v-model="form.shirt_size_id"
                    keyIndex="id"
                    valueIndex="id"
                    labelIndex="title"
                    :data="shirtSizes"
                    id="shirt_size_id"
                    class="mt-1 block w-full"
                    required
                    :show-choose="true"
                ></SelectInput>

                <InputError class="mt-2" :message="form.errors.shirt_size_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="club" :value="__('auth.club')" />

                <TextInput
                    id="club"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.club"
                    autocomplete="club"
                />

                <InputError class="mt-2" :message="form.errors.club" />
            </div>

            <div class="mt-4">
                <InputLabel for="address" :value="__('auth.address')" />

                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    autocomplete="address"
                />

                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="city"
                    :required="true"
                    :value="__('auth.city')"
                />

                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    required
                    autocomplete="city"
                />

                <InputError class="mt-2" :message="form.errors.city" />
            </div>

            <div class="mt-4">
                <InputLabel for="postal_code" :value="__('auth.postal_code')" />

                <TextInput
                    id="postal_code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.postal_code"
                    autocomplete="postal_code"
                />

                <InputError class="mt-2" :message="form.errors.postal_code" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="country_id"
                    :required="true"
                    :value="__('auth.country')"
                />

                <SelectInput
                    v-model="form.country_id"
                    keyIndex="id"
                    valueIndex="id"
                    labelIndex="title"
                    :data="countries"
                    id="country_id"
                    class="mt-1 block w-full"
                    required
                ></SelectInput>

                <InputError class="mt-2" :message="form.errors.country_id" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="emergency_phone"
                    :value="__('auth.emergency_phone')"
                />

                <TextInput
                    id="emergency_phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.emergency_phone"
                    autocomplete="emergency_phone"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.emergency_phone"
                />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
