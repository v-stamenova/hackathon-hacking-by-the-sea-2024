<x-app-layout>
    <div class="w-full p-8 overflow-y-auto">
        <div class="pb-5">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Create study group
            </h2>
            <h4 class="font-semibold text-lg text-gray-800 leading-tight">
                Start studying alongside friends and with the help of DaanGPT!
            </h4>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf

                <!-- Topic -->
                <div class="mb-4">
                    <label for="topic"
                           class="block text-gray-700 text-sm font-bold mb-2 after:content-['*'] after:text-red-500">
                        {{ __('Topic') }}
                    </label>
                    <input required type="text" id="topic" name="topic"
                           class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Enter the topic of the room">
                </div>

                <!-- Goal -->
                <div class="mb-4">
                    <label for="goal"
                           class="block text-gray-700 text-sm font-bold mb-2 after:content-['*'] after:text-red-500">
                        {{ __('Goal') }}
                    </label>
                    <textarea required id="goal" name="goal" rows="4"
                              class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              placeholder="Enter the goal of the group"></textarea>
                </div>

                <!-- Select Users -->
                <!-- Select Users -->
                <div class="mb-4">
                    <label for="user-email" class="block text-gray-700 text-sm font-bold mb-2">
                        {{ __('Invite Users by Email') }}
                    </label>
                    <input type="email" id="user-email"
                           class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Enter user email">
                    <p id="email-error" class="text-red-500 text-xs mt-2 hidden">Email must end with @hz.nl</p>
                    <button type="button" onclick="addUser()"
                            class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700 focus:outline-none focus:shadow-outline mt-2">
                        {{ __('Add User') }}
                    </button>
                </div>

                <!-- Hidden Input for Emails -->
                <input type="hidden" id="user-emails" name="user_emails">

                <!-- Invited Users List -->
                <div id="invited-users" class="mt-4">
                    <h3 class="text-gray-700 text-sm font-bold mb-2">{{ __('Invited Users') }}</h3>
                    <ul id="user-list" class="list-disc list-inside text-gray-700"></ul>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-700 focus:outline-none focus:shadow-outline">
                        {{ __('Create Room') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    let userEmails = [];

    function addUser() {
        const emailInput = document.getElementById('user-email');
        const email = emailInput.value.trim();
        const emailError = document.getElementById('email-error');

        if (email.endsWith('@hz.nl')) {
            if (!userEmails.includes(email)) {
                userEmails.push(email);
                updateEmailList();
                emailInput.value = '';
                emailInput.classList.remove('border-red-500');
                emailError.classList.add('hidden');
            }
        } else {
            emailInput.classList.add('border-red-500');
            emailError.classList.remove('hidden');
        }
    }

    function removeUser(email) {
        userEmails = userEmails.filter(userEmail => userEmail !== email);
        updateEmailList();
    }

    function updateEmailList() {
        const userList = document.getElementById('user-list');
        userList.innerHTML = '';

        userEmails.forEach(email => {
            const li = document.createElement('li');
            li.classList.add('flex', 'items-center', 'mb-2'); // Ensures text and icon are on the same level
            li.textContent = email;

            const removeButton = document.createElement('button');
            removeButton.classList.add('ml-2', 'flex', 'items-center');
            removeButton.onclick = () => removeUser(email);

            const svgIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svgIcon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            svgIcon.setAttribute('fill', 'none');
            svgIcon.setAttribute('viewBox', '0 0 24 24');
            svgIcon.setAttribute('stroke-width', '1.5');
            svgIcon.setAttribute('stroke', 'currentColor');
            svgIcon.classList.add('size-6', 'w-6', 'h-6', 'text-red-500'); // Added 'text-red-500' to make the icon red

            const path1 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path1.setAttribute('stroke-linecap', 'round');
            path1.setAttribute('stroke-linejoin', 'round');
            path1.setAttribute('d', 'M6 18L18 6M6 6l12 12');

            svgIcon.appendChild(path1);
            removeButton.appendChild(svgIcon);

            li.appendChild(removeButton);
            userList.appendChild(li);
        });

        document.getElementById('user-emails').value = JSON.stringify(userEmails);
    }

</script>
