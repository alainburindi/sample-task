<template>
  <dialog ref="dialog" class="bg-white p-6 rounded-lg">
    <form @submit.prevent="submitForm" class="space-y-4">
      <h2 class="text-2xl mb-4">Add New Guest</h2>

      <div>
        <label for="name" class="block text-lg">Guest Name:</label>
        <input
          id="name"
          v-model="formData.name"
          type="text"
          required
          class="border-2 border-gray-300 rounded-md w-full p-2"
        />
      </div>

      <div>
        <label for="room" class="block text-lg">Assign to Room:</label>
        <select
          id="room"
          v-model="formData.room"
          required
          class="border-2 border-gray-300 rounded-md w-full p-2"
        >
          <option
            v-for="room in availableRooms"
            :key="room.id"
            :value="room.name"
          >
            {{ room.name }}
          </option>
        </select>
      </div>

      <div class="flex justify-end space-x-4 mt-6">
        <button
          type="button"
          @click="closeDialog"
          class="bg-gray-500 text-white px-4 py-2 rounded-md"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="bg-red-700 text-white px-4 py-2 rounded-md"
        >
          Add Guest
        </button>
      </div>
    </form>
  </dialog>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';

interface Room {
  id: number;
  name: string;
}

export default defineComponent({
  emits: ['submit'],
  props: {
    availableRooms: {
      type: Array as () => Room[],
      required: true,
    },
  },
  setup(_, { emit }) {
    const dialog = ref<HTMLDialogElement | null>(null);

    const formData = ref({
      name: '',
      room: '',
    });

    const openDialog = () => {
      dialog.value?.showModal();
    };

    const closeDialog = () => {
      dialog.value?.close();
    };

    const submitForm = () => {
      emit('submit', formData.value);
      closeDialog();
    };

    return {
      dialog,
      formData,
      openDialog,
      closeDialog,
      submitForm,
    };
  },
});
</script>

<style scoped>
dialog[open] {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
