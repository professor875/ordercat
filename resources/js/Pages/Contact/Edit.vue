<script setup>
import {trans} from "@/utils.js";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import SelectInput from "@/Components/Forms/SelectInput.vue";

const props = defineProps({
    contact: Object,
    types: Array,
    contact_channel: Array
})

const form = useForm({
    _method: 'PUT',
    name: props.contact.name,
    type: props.contact.type,
    contact_channel: props.contact.contact_channel,
    sms: props.contact.sms,
    email: props.contact.email,
    whatsapp: props.contact.whatsapp,
    phone: props.contact.phone,
});

const submit = () => {
    form.post(route('contacts.update', props.contact.id));
}

</script>
<template>
    <Head :title="trans('Contact')"/>

    <BreadcrumbDefault :pageTitle="trans('Contact')"/>

    <Link :href="route('contacts.index')">
        <PrimaryButton>{{ trans('Back') }}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Update Contact')" class="mt-4 border-warning">
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
                    >{{ trans(contact_channel.name) }}
                    </option>
                </SelectInput>

                <SelectInput
                    :label="trans('Type')"
                    :required="true"
                    :error="form.errors.type"
                    v-model="form.type"
                >
                    <option value="" selected disabled>{{ trans('Select type') }}</option>
                    <option
                        v-for="(type, index) in types"
                        :key="index"
                        :value="type.value"
                    >{{ trans(type.name) }}
                    </option>
                </SelectInput>

                <TextInput
                    v-show="form.contact_channel === 'sms'"
                    :label="trans('SMS')"
                    type="text"
                    :placeholder="trans('Enter your number.')"
                    v-model="form.sms"
                    :error="form.errors.sms"
                />

                <TextInput
                    v-show="form.contact_channel  === 'email'"
                    :label="trans('Email')"
                    type="text"
                    :placeholder="trans('Enter your email.')"
                    v-model="form.email"
                    :error="form.errors.email"
                />

                <TextInput
                    v-show="form.contact_channel  === 'whatsapp'"
                    :label="trans('Whatsapp')"
                    type="text"
                    :placeholder="trans('Enter your number.')"
                    v-model="form.whatsapp"
                    :error="form.errors.whatsapp"
                />

                <TextInput
                    v-show="form.contact_channel  === 'phone'"
                    :label="trans('Phone')"
                    type="text"
                    :placeholder="trans('Enter your number.')"
                    v-model="form.phone"
                    :error="form.errors.phone"
                />
            </div>

            <div class="flex justify-end mt-4.5">
                <PrimaryButton>{{ trans('Update') }}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>

</template>
