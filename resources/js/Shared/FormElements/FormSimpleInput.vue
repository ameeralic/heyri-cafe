<template>
    <div class="mb-2">
        <label
            :for="name"
            >{{ label }}</label
        >
        <div class="flex">
            <span
            v-if="preText"
                class="input-field-pretext"
            >
                {{ preText }}
            </span>
            <input
                :type="type"
                :name="name"
                :placeholder="placeholder ?? ''"
                :id="name"
                :value="readOnly ?? modelValue"
                :disabled="disabled"
                @input="$emit('update:modelValue', $event.target.value)"
                :class="{
                    'border-2 border-error': error,
                    'cursor-not-allowed': disabled,
                    'rounded-s-none':preText
                }"
                class="input-field-text"
            />
        </div>

        <div
            v-if="error"
            v-text="error"
            class="input-error-msg"
        ></div>
    </div>
</template>
<script>
export default {
    props: [
        "label",
        "type",
        "modelValue",
        "error",
        "name",
        "placeholder",
        "disabled",
        "readOnly",
        "preText"
    ],
    emits: ["update:modelValue"],
};
</script>
