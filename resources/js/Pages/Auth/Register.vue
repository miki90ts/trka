<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    birthday: "",
    gender: "",
    country_id: "162",
    city: "",
    phone: "",
    password: "",
    password_confirmation: "",
});

const props = defineProps({
    countries: {
        type: Array,
    },
    genders: {
        type: Array,
    },
});

const format = (date) => {
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="grid md:grid-cols-2 gap-2">
                <div class="w-full">
                    <InputLabel
                        for="first_name"
                        :value="__('auth.first_name')"
                    />

                    <TextInput
                        id="first_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.first_name"
                        required
                        autofocus
                        autocomplete="first_name"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.first_name"
                    />
                </div>

                <div class="w-full">
                    <InputLabel for="last_name" :value="__('auth.last_name')" />

                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name"
                        required
                        autocomplete="last_name"
                    />

                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-2 mt-4">
                <div>
                    <InputLabel for="email" :value="__('auth.email')" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="email"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
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
                        class="mt-1"
                    ></VueDatePicker>

                    <InputError class="mt-2" :message="form.errors.birthday" />
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-2 mt-4">
                <div>
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

                <div>
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

                    <InputError
                        class="mt-2"
                        :message="form.errors.country_id"
                    />
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-2 mt-4">
                <div>
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

                <div>
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
            </div>

            <div class="grid md:grid-cols-2 gap-2 mt-4">
                <div>
                    <InputLabel for="password" :value="__('auth.password')" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel
                        for="password_confirmation"
                        :value="__('auth.confirm_password')"
                    />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<style>
.dp__input {
    height: 42px;
}
</style>
