<script setup>
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import {trans} from "@/utils.js";
import SelectInput from "@/Components/Forms/SelectInput.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import MultiSelect from "@/Components/Forms/MultiSelect.vue";
import {computed} from "vue";

const props = defineProps({
    contact_channel: Array,
    roles: Object
})

const form = useForm({
    _method: 'POST',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    contact_channel: '',
    contact_number: '',
    roles:[]
});

const submit = () => {
    form.post(route('users.store'));
}

</script>

<template>
    <Head :title="trans('User')"/>

    <BreadcrumbDefault :pageTitle="trans('User')"/>

    <Link :href="route('users.index')">
        <PrimaryButton>{{ trans('Back') }}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Create User')" class="mt-4 border-success">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4.5">
                <TextInput
                    :label="trans('Name')"
                    type="text"
                    :placeholder="trans('Enter Name')"
                    :required="true"
                    v-model="form.name"
                    :error="form.errors.name"
                />

                <TextInput
                    :label="trans('Email')"
                    type="email"
                    :placeholder="trans('Enter Email')"
                    :required="true"
                    v-model="form.email"
                    :error="form.errors.email"
                />

                <TextInput
                    :label="trans('Password')"
                    type="password"
                    :placeholder="trans('Enter Password')"
                    :required="true"
                    v-model="form.password"
                    :error="form.errors.password"
                />

                <TextInput
                    :label="trans('Confirm Password')"
                    type="password"
                    :placeholder="trans('Confirm Password')"
                    :required="true"
                    v-model="form.password_confirmation"
                    :error="form.errors.password_confirmation"
                />

                <SelectInput
                    :label="trans('Contact Channel')"
                    :required="true"
                    :error="form.errors.type"
                    v-model="form.contact_channel"
                >
                    <option value="" selected disabled>{{ trans('Select type') }}</option>
                    <option
                        v-for="(contact_channel, index) in contact_channel"
                        :key="index"
                        :value="contact_channel.value"
                    >{{ contact_channel.name }}
                    </option>
                </SelectInput>

                <TextInput
                    v-show="form.contact_channel !== 'email'"
                    :label="trans('Contact Number')"
                    type="text"
                    :placeholder="trans('Enter Contact Number.')"
                    v-model="form.contact_number"
                    :error="form.errors.contact_number"
                />

                <MultiSelect
                    label="Roles"
                    v-model="form.roles"
                    :options="props.roles"
                    :error="form.errors.roles"
                    :placeholder="trans('Please select roles')"
                />
            </div>

            <div class="flex justify-end mt-4.5">
                <PrimaryButton>{{trans('Create')}}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>
</template>
