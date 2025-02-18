<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const categories = ref([]);
const selectedCategory = ref(null);
const codes = ref([]);
const selectedCode = ref('');
const output = ref('');
const activeCodeId = ref(null);

// Fetch categories on mount
onMounted(async () => {
    try {
        const response = await axios.get('/api/categories');
        categories.value = response.data;
        console.log('Fetched Categories:', categories.value);
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
});

// Fetch codes for selected category
const fetchCodes = async (category) => {
    selectedCategory.value = category;
    codes.value = category.code_listing; // Assuming code_listing is already included
};

// Run selected PHP code
const runCode = async () => {
    try {
        const response = await axios.post('/api/execute', { code: selectedCode.value });
        output.value = response.data.output;
    } catch (error) {
        output.value = '<span class="text-danger">Error executing code</span>';
    }
};

// Watch for code selection to set the active ID
watch(selectedCode, (newValue) => {
    const selected = codes.value.find(code => code.content === newValue);
    activeCodeId.value = selected ? selected.id : null;
});
</script>

<template>
    <Head title="Welcome" />
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar vh-100">
                <div class="position-sticky">
                    <h4 class="p-3 text-center">Code Runner</h4>
                    <ul class="nav flex-column">
                        <li v-for="category in categories" :key="category.id" class="nav-item">
                            <a 
                                class="nav-link text-white" 
                                href="javascript:void(0)" 
                                :class="{ 'bg-primary': selectedCategory?.id === category.id }"
                                @click="fetchCodes(category)"
                            >
                                {{ category.title }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-5 ms-sm-auto col-lg-5 px-md-4 py-4">
                <h2 class="mb-3">PHP Code Runner</h2>

                <!-- Code Execution -->
                <div class="mb-3">
                    <label for="codeEditor" class="form-label fw-bold">Write or Modify Code:</label>
                    <div class="editor-container">
                        <textarea 
                            v-model="selectedCode" 
                            id="codeEditor" 
                            class="form-control code-textarea" 
                            rows="6"
                            placeholder="Write your PHP code here..."
                        ></textarea>
                    </div>
                    <button @click="runCode" class="btn btn-success mt-3 w-100">
                        <i class="fas fa-play"></i> Run Code
                    </button>
                </div>

                <!-- Output -->
                <div class="mt-4">
                    <h5 class="fw-bold">Output:</h5>
                    <div class="alert alert-secondary" v-html="output"></div>
                </div>
            </main>
            
            <!-- Code Listing Section -->
            <main class="col-md-4 ms-sm-auto col-lg-4 px-md-4 py-4">
                <div v-if="selectedCategory" class="mb-3">
                    <h5 class="fw-bold">Available Codes in: {{ selectedCategory.title }}</h5>
                </div>

                <!-- Scrollable Code List -->
                <div v-if="codes.length" class="code-list-container">
                    <ul class="list-group">
                        <li 
                            v-for="code in codes" 
                            :key="code.id" 
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            :class="{ 'active': activeCodeId === code.id }"
                            @click="selectedCode = code.code"
                        >
                            {{ code.title }}
                            <i class="fas fa-code"></i>
                        </li>
                    </ul>
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
/* Sidebar */
.sidebar {
    min-height: 100vh;
}

/* Navbar Links */
.nav-link {
    cursor: pointer;
}

/* Code Textarea */
.code-textarea {
    font-family: "Courier New", monospace;
    background-color: #2d2d2d;
    color: #f8f8f2;
    border-radius: 5px;
    padding: 10px;
}

/* Code Listing */
.code-list-container {
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    background-color: #f8f9fa;
}

.list-group-item {
    cursor: pointer;
    transition: 0.2s;
}

.list-group-item:hover {
    background-color: #007bff;
    color: white;
}

.list-group-item.active {
    background-color: #007bff !important;
    color: white !important;
}
</style>
