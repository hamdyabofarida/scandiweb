<template>
	<router-view />
</template>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap");

*,
*:after,
*:before {
	box-sizing: border-box;
}

body {
	font-family: "DM Sans", sans-serif;
	line-height: 1.5;
	background-color: #f1f3fb;
	padding: 0 2rem;
}

.container {
	margin: 0 auto;
	width: 80%;
	padding: 2rem 1rem 0;
}

a {
	color: inherit;
	text-decoration: none;
}

header {
	position: relative;
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 20px;

	&::after {
		content: "";
		position: absolute;
		height: 1px;
		width: 100%;
		border-radius: 50%;
		background-color: #504f4f;
		margin-top: 55px;
	}
}

.input {
	position: relative;
	display: flex;
	flex-direction: column-reverse;
	position: relative;
	padding-top: 1.5rem;

	&+.input {
		margin-top: 1.5rem;
	}
}

.input-label {
	color: #8597a3;
	position: absolute;
	top: 1.5rem;
	transition: 0.25s ease;
}

.input-field {
	border: 0;
	z-index: 1;
	background-color: transparent;
	border-bottom: 2px solid #9d9999;
	font: inherit;
	font-size: 1.125rem;
	padding: 0.25rem 0;
	width: 40%;

	&:focus {
		outline: 0;
		border-bottom-color: #fd9644;

		&+.input-label {
			color: #fd9644;
			transform: translateY(-1.5rem);
		}
	}
}

.valid {
	outline: 0;
	border-bottom-color: #fd9644;

	&+.input-label {
		color: #fd9644;
		transform: translateY(-1.5rem);
	}
}

.select {
	border: 2px solid #9d9999;

	&:focus {
		border-color: #fd9644;
	}
}

.select.valid {
	border-color: #fd9644;
}

.action-button {
	font: inherit;
	font-size: 1.25rem;
	padding: 3px 5px;
	font-weight: 500;
	background-color: #fd9644;
	border-radius: 6px;
	color: #fff;
	border: 0;
	margin-left: 5px;
	cursor: pointer;

	&:focus {
		outline: 0;
	}
}

.error {
	color: #e74c3c;
	position: absolute;
	margin-left: 20px;
	left: 40%;
}

.hidden {
	display: none;
}

.danger {
	outline: 0;
	border-bottom-color: #e74c3c;

	&+.input-label {
		color: #e74c3c;
		transform: translateY(-1.5rem);
	}
}

.select.danger {
	border-color: #e74c3c;
}

#attributes {
	margin-top: 20px;
}


.checkbox-group {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	width: 90%;
	margin-left: auto;
	margin-right: auto;
	user-select: none;

	&>* {
		margin: .5rem 0.5rem;
	}
}

.checkbox-input {
	// Code to hide the input
	height: 1px;
	overflow: hidden;
	position: absolute;
	white-space: nowrap;
	width: 1px;

	&:checked+.checkbox-tile {
		border-color: #fc5c65;
		box-shadow: 0 5px 10px rgba(#000, 0.1);
		color: #fc5c65;

		&:before {
			transform: scale(1);
			opacity: 1;
			background-color: #fc5c65;
			border-color: #fc5c65;
		}

		.checkbox-icon,
		.checkbox-label {
			color: #fc5c65;
		}
	}

	&:focus+.checkbox-tile {
		border-color: #fc5c65;
		box-shadow: 0 5px 10px rgba(#000, 0.1), 0 0 0 4px #fd974452;

		&:before {
			transform: scale(1);
			opacity: 1;
		}
	}
}

.checkbox-tile {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	width: 10rem;
	min-height: 7rem;
	border-radius: 0.5rem;
	border: 2px solid #b5bfd9;
	background-color: #fff;
	box-shadow: 0 5px 10px rgba(#000, 0.1);
	transition: 0.15s ease;
	cursor: pointer;
	position: relative;
	padding: 20px;

	&:before {
		content: "";
		position: absolute;
		display: block;
		width: 1.25rem;
		height: 1.25rem;
		border: 2px solid #b5bfd9;
		background-color: #fff;
		border-radius: 50%;
		top: 0.25rem;
		left: 0.25rem;
		opacity: 0;
		transform: scale(0);
		transition: 0.25s ease;
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
		background-size: 12px;
		background-repeat: no-repeat;
		background-position: 50% 50%;
	}

	&:hover {
		border-color: #fc5c65;

		&:before {
			transform: scale(1);
			opacity: 1;
		}
	}
}

.checkbox-label {
	margin-top: 3px;
	color: #707070;
	transition: .375s ease;
	text-align: center;
}</style>
