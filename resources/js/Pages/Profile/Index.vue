<script setup>
import {trans} from "@/utils.js";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import {useForm, Head} from "@inertiajs/vue3";
import SelectInput from "@/Components/Forms/SelectInput.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";

const props = defineProps({
    user: Object,
    contactChannels: Array
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    contact_channel: props.user.contact_channel,
    contact_number: props.user.contact_number,
})

const passwordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
})

const dpForm = useForm({
    _method: 'PUT',
    dp: null
})

const updateProfile = () => {
    form.put(route('profile.update'));
}

const updatePassword = () => {
    passwordForm.put(route('profile.password-update'), {
        onSuccess: () => passwordForm.reset()
    });
}

const updateDp = (event) => {
    dpForm.dp = event.target.files[0];
    dpForm.post(route('profile.update-dp'))
}
</script>
<template>
    <Head :title="trans('Profile')"/>

    <BreadcrumbDefault :pageTitle="trans('Profile')"/>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-3 bg-white dark:bg-black p-12 rounded-lg flex flex-col items-center w-full h-full">
            <label for="profile-image" class="mb-6 cursor-pointer">
                <img
                    class="w-30 rounded-full"
                    :src="user.dp"
                    alt=""
                >
            </label>

            <input type="file" class="sr-only" id="profile-image" @change="updateDp($event)">

            <div class="text-center">
                <h2 v-text="props.user.name"></h2>
                <p v-text="props.user.email"></p>
            </div>
        </div>

        <div class="col-span-12 md:col-span-9 bg-white dark:bg-black p-12 rounded-lg md:grid space-y-4.5 md:space-y-0 gap-x-6 gap-y-4.5">
            <h1 class="text-black dark:text-white col-span-2 font-bold text-2xl">{{ trans('Profile') }}</h1>

            <TextInput
                v-model="form.name"
                :label="trans('Name')"
                :required="true"
                :placeholder="trans('Enter Name')"
                :error="form.errors.name"
            />

            <TextInput
                v-model="form.email"
                type="email"
                :label="trans('Email')"
                :placeholder="trans('Enter Email')"
                :required="true"
                :error="form.errors.email"
                :readonly="true"
                :disable="true"
            />

            <SelectInput
                v-model="form.contact_channel"
                :label="trans('Contact Channel')"
                :error="form.errors.contact_channel"
            >
                <option value="" disabled>{{trans('Select contact channel')}}</option>
                <option
                    v-for="(contactChannel, index) in contactChannels"
                    :key="index"
                    :value="contactChannel.name"
                >{{contactChannel.name}}</option>
            </SelectInput>

            <TextInput
                v-model="form.contact_number"
                :label="trans('Contact Number')"
                :placeholder="trans('Enter Contact Number')"
                :required="true"
                :error="form.errors.contact_number"
            />

            <div class="col-span-2 flex justify-end">
                <PrimaryButton type="submit" @click="updateProfile">{{ form.processing ? trans('Please wait...') : trans('Update Profile') }}</PrimaryButton>
            </div>

            <h1 class="text-black dark:text-white col-span-2 font-bold text-2xl">{{trans('Password')}}</h1>

            <TextInput
                v-model="passwordForm.current_password"
                type="password"
                :placeholder="trans('Enter Current Password')"
                :label="trans('Current password')"
                :required="true"
                :error="passwordForm.errors.current_password"
            />

            <TextInput
                v-model="passwordForm.password"
                type="password"
                :placeholder="trans('Enter New Password')"
                :label="trans('New password')"
                :required="true"
                :error="passwordForm.errors.password"
            />

            <TextInput
                v-model="passwordForm.password_confirmation"
                type="password"
                :placeholder="trans('Confirm Password')"
                :label="trans('Password Confirmation')"
                :required="true"
                :error="passwordForm.errors.password_confirmation"
            />

            <div class="col-span-2 flex justify-end">
                <PrimaryButton type="submit" @click="updatePassword">{{ trans('Update Password') }}</PrimaryButton>
            </div>

        </div>
    </div>

</template>
