<script setup>
import {trans} from "@/utils.js";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import SelectInput from "@/Components/Forms/SelectInput.vue";

const props = defineProps({
    stage: Object,
    contacts: Object,
    buildings: Object,
    kitchens: Object,
    items: Object,
})

const form = useForm({
    _method: 'PUT',
    description: props.stage.description,
    ordered_for_id: props.stage.orderedFor?.id,
    ordered_from_id: props.stage.orderedFrom?.id,
    delivery_at: props.stage.delivery_at,
    items: props.stage.items,
    note: props.stage.note
});

const addItem = () => {
    form.items.push({
        id: '',
        quantity : 1,
    });
}

const removeItem = (index) => {
    console.log('removing')
    form.items.splice(index, 1);
}

const submit = () => {
    form.post(route('stages.update', props.stage.id));
}

</script>

<template>
    <Head :title="trans('Stage')"/>

    <BreadcrumbDefault :pageTitle="trans('Stage')"/>

    <Link :href="route('stages.index')">
        <PrimaryButton>{{ trans('Back') }}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Update Stage')" class="mt-4 border-warning">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4.5">
                <TextInput
                    :label="trans('Description')"
                    type="text"
                    :placeholder="trans('Enter Description')"
                    :required="true"
                    v-model="form.description"
                    :error="form.errors.description"
                />

                <SelectInput
                    :label="trans('Select Building')"
                    :required="true"
                    :error="form.errors.ordered_for_id"
                    v-model="form.ordered_for_id"
                >
                    <option value="" selected disabled>{{ trans('Select Building') }}</option>
                    <option
                        v-for="(building, index) in buildings"
                        :key="index"
                        :value="building.id"
                    >{{ building.title }}
                    </option>
                </SelectInput>

                <SelectInput
                    :label="trans('Select Kitchen')"
                    :required="true"
                    :error="form.errors.ordered_from_id"
                    v-model="form.ordered_from_id"
                >
                    <option value="" selected disabled>{{ trans('Select Kitchen') }}</option>
                    <option
                        v-for="(kitchen, index) in kitchens"
                        :key="index"
                        :value="kitchen.id"
                    >{{ kitchen.title }}
                    </option>
                </SelectInput>

                <TextInput
                    :label="trans('Delivery')"
                    type="datetime-local"
                    v-model="form.delivery_at"
                    :error="form.errors.delivery_at"
                />

                <label for="note" class="col-span-2">
                    <span class="mb-2.5 block text-black dark:text-white">Note</span>
                    <textarea
                        v-model="form.note"
                        name="note"
                        id="note"
                        class="outline-none rounded-lg w-full dark:bg-black border border-stroke dark:border-form-strokedark focus:border-primary dark:focus:border-primary p-4 dark:text-white text-black"
                        rows="3"></textarea>
                </label>

                <div v-for="(_, index) in form.items" :key="index" class="flex items-end gap-x-2 col-span-2">
                    <SelectInput
                        :label="trans('Select Item')"
                        class="w-full"
                        :required="true"
                        :error="form.errors[`items.${index}.id`]"
                        v-model="form.items[index].id"
                    >
                        <option value="" selected disabled>{{ trans('Select item') }}</option>
                        <option
                            v-for="(item, index) in items"
                            :key="index"
                            :value="item.id"
                        >{{ item.title }}
                        </option>
                    </SelectInput>

                    <TextInput
                        :label="trans('Select Quantity')"
                        type="number"
                        min="1"
                        :required="true"
                        v-model="form.items[index].quantity"
                        :error="form.errors[`items.${index}.quantity`]"
                    />

                    <PrimaryButton type="button" v-show="form.items.length === index + 1" class="" @click="addItem">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM15 11H11V15H9V11H5V9H9V5H11V9H15V11Z" fill="white"/>
                        </svg>
                    </PrimaryButton>
                    <PrimaryButton type="button" v-show="(form.items.length !== index + 1 || form.items.length === index + 1) && form.items.length > 1" class="bg-red" @click="removeItem(index)">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM2 10C2 5.58 5.58 2 10 2C11.85 2 13.55 2.63 14.9 3.69L3.69 14.9C2.63 13.55 2 11.85 2 10ZM10 18C8.15 18 6.45 17.37 5.1 16.31L16.31 5.1C17.37 6.45 18 8.15 18 10C18 14.42 14.42 18 10 18Z" fill="white"/>
                        </svg>
                    </PrimaryButton>
                </div>
            </div>

            <div class="flex justify-end mt-4.5">
                <PrimaryButton>{{ trans('Update') }}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>
</template>
