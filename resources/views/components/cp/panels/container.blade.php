@props(['panels' => [], 'loop' => 0])

<div x-cloak id="panels-container" x-data="panelManager()">
    <x-panels.draggable-container class="space-y-2">
        <template x-for="(panel, index) in allPanels" :key="panel.id || index">
            <div @delete-panel="deletePanel($event.detail)" x-html="panel.html"></div>
        </template>
    </x-panels.draggable-container>

    <x-secondary-button class="mt-2 border-dashed" @click="addPanel()">Add new set</x-secondary-button>
</div>

<script>
    function panelManager() {
        return {
            allPanels: [
                @foreach($panels as $panel)
                {
                    id: {{ $panel->id }},
                    html: @json(view('components.panels.item', [
                            'panel' => $panel,
                            'dataName' => "content[{$loop->parent->index}][data][{$loop->index}]"
                        ])->render())
                },
                @endforeach
            ],
            loading: false,

            async addPanel() {
                this.loading = true;

                try {
                    const response = await useAjax().call('{{ route("cp.content.pages.panel.add") }}', 'POST', {
                        new_order: this.allPanels.length,
                        loop_index: {{ $loop->index ?? 0 }},
                        panel: @json($panels->first()),
                    });

                    this.allPanels.push({
                        id: response.id,
                        html: response.html,
                    });
                } catch (error) {
                    console.error('Ошибка при добавлении панели:', error);
                } finally {
                    this.loading = false;
                }
            },

            async deletePanel(panelId) {
                if (!confirm('Вы уверены, что хотите удалить эту панель?')) return;

                this.loading = true;

                try {
                    await useAjax().call('{{ route("cp.content.pages.panel.delete") }}', 'POST', {
                        panel_id: panelId,
                    });

                    const index = this.allPanels.findIndex(p => p.id === panelId);
                    if (index !== -1) {
                        this.allPanels.splice(index, 1);
                    }
                } catch (error) {
                    console.error('Ошибка при удалении панели:', error);
                } finally {
                    this.loading = false;
                }
            }
        };
    }
</script>
