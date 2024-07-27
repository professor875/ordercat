<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/Forms/TextInput.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import SelectInput from "@/Components/Forms/SelectInput.vue";
import {trans} from "../../utils.js";

defineProps({
    types: Array,
    users : Object
})

const form = useForm({
    title: '',
    type: '',
    inhabitants_count: 1,
    location_coordinate: '',
    user_id: '',
});

const submit = () => {
    form.post(route('buildings.store'));
}
</script>

<template>
    <Head :title="trans('Building')"/>
    <BreadcrumbDefault :pageTitle="trans('Building')"/>

    <Link :href="route('buildings.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Create Building')" class="mt-4 border-success">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4.5">
                <TextInput
                    :label="trans('Title')"
                    type="text"
                    :placeholder="trans('Enter title')"
                    :required="true"
                    v-model="form.title"
                    :error="form.errors.title"
                />

                <SelectInput
                    :label="trans('Type')"
                    :required="true"
                    :error="form.errors.type"
                    v-model="form.type"
                >
                    <option value="" selected disabled>{{trans('Select type')}}</option>
                    <option
                        v-for="(type, index) in types"
                        :key="index"
                        :value="type.value"
                    >{{ trans(type.name) }}</option>
                </SelectInput>

                <TextInput
                    :label="trans('Inhabitants Count')"
                    type="number"
                    min="1"
                    :placeholder="trans('Enter inhabitants count')"
                    v-model="form.inhabitants_count"
                    :error="form.errors.inhabitants_count"
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
                        :value="user.id"
                    >{{ trans(user.name) }}</option>
                </SelectInput>
            </div>

            <div class="flex justify-end mt-4.5">
                <PrimaryButton>{{trans('Create')}}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>
</template>
