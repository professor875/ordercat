<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/Forms/TextInput.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import {trans} from "../../utils.js";
import SelectInput from "@/Components/Forms/SelectInput.vue";

defineProps({
    users: Object,
})

const form = useForm({
    title: '',
    commercial_registration: '',
    location_coordinate: '',
    user_id: '',
});

const submit = () => {
    form.post(route('kitchens.store'));
}
</script>

<template>
    <Head :title="trans('Kitchen')"/>
    <BreadcrumbDefault :pageTitle="trans('Kitchen')"/>

    <Link :href="route('kitchens.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Create Kitchen')" class="mt-4 border-success">
        <form @submit.prevent="submit" class="flex flex-col gap-y-4.5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <TextInput
                    :label="trans('Title')"
                    type="text"
                    :placeholder="trans('Enter title')"
                    :required="true"
                    v-model="form.title"
                    :error="form.errors.title"
                />

                <TextInput
                    :label="trans('Commercial Registration')"
                    type="text"
                    :placeholder="trans('Enter commercial registration')"
                    v-model="form.commercial_registration"
                    :error="form.errors.commercial_registration"
                />

                <TextInput
                    :label="trans('Location Coordinate')"
                    type="text"
                    :placeholder="trans('Enter location coordinate')"
                    v-model="form.location_coordinate"
                    :error="form.errors.location_coordinate"
                />
                <SelectInput
                    :label="trans('User')"
                    :required="true"
                    :error="form.errors.user_id"
                    v-model="form.user_id"
                >
                    <option value="" selected disabled>{{trans('Select User')}}</option>
                    <option
                        v-for="(user, index) in users"
                        :key="index"
                        :value="trans(user.id)"
                    >{{user.name}}</option>
                </SelectInput>
            </div>

            <div class="flex justify-end">
                <PrimaryButton>{{trans('Create')}}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>
</template>
