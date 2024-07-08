import { useState } from '@wordpress/element';
import {
	DndContext,
	closestCenter,
	KeyboardSensor,
	PointerSensor,
	useSensor,
	useSensors,
} from '@dnd-kit/core';
import {
	arrayMove,
	SortableContext,
	sortableKeyboardCoordinates,
	verticalListSortingStrategy,
	horizontalListSortingStrategy
} from '@dnd-kit/sortable';


export default function Sortable({ children, items, onSort }) {
	const sensors = useSensors(
		useSensor(PointerSensor),
		useSensor(KeyboardSensor, {
			coordinateGetter: sortableKeyboardCoordinates,
		})
	);

	return (
		<DndContext
			sensors={sensors}
			collisionDetection={closestCenter}
			onDragEnd={handleDragEnd}
		>
			<SortableContext
				items={items}
				strategy={horizontalListSortingStrategy}
			>
				{children}
			</SortableContext>
		</DndContext>
	);

	function handleDragEnd(event) {
		const {active, over} = event;

		if (active.id !== over.id) {
			const oldIndex = items.findIndex(item => item.id === active.id);
			const newIndex = items.findIndex(item => item.id === over.id);
			const updatedOrder = arrayMove(items, oldIndex, newIndex);
			onSort(updatedOrder);
		}
	}
}
